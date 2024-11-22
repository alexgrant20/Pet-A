@extends('layouts.master.layout')

@section('title', 'Veterinarian Schedule')

@section('content')
   <div class="card bg-base-100 shadow-xl w-full mb-5">
      <div class="card-body flex-row items-center justify-between">
         <div>
            <h1 class="font-bold text-2xl">Veterinarian Schedule</h1>
            {{ Breadcrumbs::render('appointment-schedule') }}
         </div>
      </div>
   </div>

   <div class="card bg-base-100 shadow-xl w-full">
      <div class="card-body">
         <div class="w-full">
            @foreach ($dayMapping as $dayNumeric => $dayName)
               <div class="collapse collapse-arrow join-item border-primary border mb-3">
                  <input type="radio" name="my-accordion-4" />
                  <div class="collapse-title text-xl text-md items-center flex gap-2">
                     <input type="checkbox" class="toggle toggle-primary toggle-schedule-day form-control z-10"
                        data-id="{{ $dayNumeric }}" @if ($scheduleDay->contains($dayNumeric)) checked @endif />
                     {{ $dayName }}
                  </div>
                  <div class="collapse-content">
                     <form action="{{ route('admin.appointment-schedule.save-schedule', ['day' => $dayNumeric]) }}"
                        method="POST" id="schedule_form_{{ $dayNumeric }}">
                        @csrf

                        @if (@$appointmentSchedules[$dayNumeric])
                           @foreach (@$appointmentSchedules[$dayNumeric] as $appointmentSchedule)
                              @php
                                 $totalAppointmentSchedules[$dayNumeric] = $appointmentSchedules[$dayNumeric]->count();
                              @endphp
                              <div class="flex gap-3 items-center mb-3 schedule-row">
                                 <div class="flex-1">
                                    <input type="hidden" name="appointment_schedule[id][{{ $loop->index }}]"
                                       value="{{ Crypt::encrypt($appointmentSchedule->id) }}" class="">
                                    <input type="time" name="appointment_schedule[start_time][{{ $loop->index }}]"
                                       class="input input-bordered w-full form-validation"
                                       value="{{ $appointmentSchedule->start_time->format('H:i') }}" />
                                 </div>

                                 <div class="px-2 grid-cols-2 gap-3 flex">
                                    @if ($loop->last)
                                       <a href="#" class="btn-add-schedule" data-id="{{ $dayNumeric }}">
                                          <i class="fa-regular fa-circle-plus text-xl text-secondary"></i>
                                       </a>
                                    @endif
                                    <a href="#"
                                       class="btn-delete-schedule @if (!$loop->last) mr-8 @endif"
                                       data-value="{{ Crypt::encrypt($appointmentSchedule->id) }}">
                                       <i class="fa-regular fa-trash-can text-xl text-error"></i>
                                    </a>
                                 </div>
                              </div>
                           @endforeach
                        @else
                           <div class="flex gap-3 items-center mb-3 schedule-row">
                              <div class="flex-1">
                                 <input type="time" name="appointment_schdule[start_time][{{ $loop->index }}]"
                                    class="input input-bordered border-2 w-full form-validation" />
                              </div>

                              <div class="px-2 grid-cols-2 gap-3 flex">
                                 <a href="#" class="btn-add-schedule" data-id="{{ $dayNumeric }}">
                                    <i class="fa-regular fa-circle-plus text-xl text-secondary"></i>
                                 </a>
                                 <a href="#" class="btn-delete-schedule" data-id="{{ $dayNumeric }}">
                                    <i class="fa-regular fa-trash-can text-xl text-error"></i>
                                 </a>
                              </div>
                           </div>
                        @endif

                        <div class="flex justify-end">
                           <button type="submit" class="btn btn-primary btn-padding btn-save-schedule"
                              data-id="{{ $dayNumeric }}">
                              Save
                           </button>
                        </div>
                     </form>
                  </div>
               </div>
            @endforeach
         </div>
      </div>
      <div class="flex gap-3 items-center mb-3 schedule-row hidden" id="template_schedule">
         <div class="flex-1">
            <input type="time" name="appointment_schedule[start_time][:idx]"
               class="input input-bordered border-2 w-full form-validation" />
         </div>

         <div class="px-2 grid-cols-2 gap-3 flex">
            <a href="#" class="btn-add-schedule" data-id=":dayId">
               <i class="fa-regular fa-circle-plus text-xl text-secondary"></i>
            </a>
            <a href="#" class="btn-delete-schedule" data-id=":dayId">
               <i class="fa-regular fa-trash-can text-xl text-error"></i>
            </a>
         </div>
      </div>
   </div>
@endsection

@section('js-footer')
   <script>
      let scheduleCounter = @json($totalAppointmentSchedules);
      const scheduleTemplate = $('#template_schedule');

      $(document).on('click', '.btn-delete-schedule', function(e) {
         e.preventDefault();
         const id = $(this).attr('data-value');
         const rowToBeRemoved = $(this).closest('.schedule-row');
         const isLastSchedule = rowToBeRemoved.is(':nth-last-child(2)');

         if (isLastSchedule && rowToBeRemoved.prev().length == 0) {
            return;
         }

         if (isLastSchedule) {
            const dayId = $(this).attr('data-id');
            const btnAddSchedule = scheduleTemplate.find('.btn-add-schedule').clone().attr('data-id', dayId)
            const prevScheduleDeleteBtn = rowToBeRemoved.prev().find('.btn-delete-schedule');
            prevScheduleDeleteBtn.removeClass('mr-8');
            btnAddSchedule.insertBefore(prevScheduleDeleteBtn);
         }

         if (id) {
            let url = "{{ route('admin.appointment-schedule.destroy', '::schedule_id::') }}";
            url = url.replace('::schedule_id::', id);
            $.ajax({
               url,
               type: 'POST',
               data: {
                  _method: 'DELETE',
                  _token: "{{ csrf_token() }}"
               },
               success: function(response) {
                  rowToBeRemoved.remove();
                  toastr.success(response.message, 'Success', {
                     "iconClass": 'toast-success'
                  });
               },
               error: function(response) {
                  toastr.error(response.message, 'Error', {
                     "iconClass": 'toast-error'
                  });
               }
            })
         } else {
            rowToBeRemoved.remove();
         }
      })

      $(document).on('click', '.btn-save-schedule', function(e) {
         e.preventDefault();
         const dayId = $(this).attr('data-id');
         const scheduleRows = $(`#schedule_form_${dayId}`).find('.schedule-row');
         let isAllScheduleValid = true;

         scheduleRows.each(function() {
            if(!validateScheduleAndSetError($(this))) {
               isAllScheduleValid = false;
            }
         })

         if(isAllScheduleValid) {
            $(`#schedule_form_${dayId}`).submit();
         }
      })

      $(document).on('click', '.btn-add-schedule', function(e) {
         e.preventDefault();
         const dayId = $(this).attr('data-id');
         const lastSchedule = $(this).closest('.schedule-row');
         if (!validateScheduleAndSetError(lastSchedule)) {
            return;
         }

         scheduleCounter[dayId] = (scheduleCounter[dayId] || 0) + 1;

         let newScheduleRow = scheduleTemplate.clone()
            .removeAttr('id')
            .removeClass('hidden');

         newScheduleRow.find("input").each(function() {
            const newName = this.name.replace(":idx", scheduleCounter[dayId]);
            $(this).prop('name', newName);
         });

         newScheduleRow.find('.btn-add-schedule').attr('data-id', dayId);
         newScheduleRow.find('.btn-delete-schedule').attr('data-id', dayId);

         const actionCell = $(this).parent();
         const deleteButton = actionCell.find('.btn-delete-schedule');
         const addButton = actionCell.find('.btn-add-schedule');

         if (deleteButton.length) {
            deleteButton.addClass('mr-8');
         }

         if (addButton.length) {
            addButton.remove();
         }

         newScheduleRow.insertAfter(lastSchedule);
      })

      $(document).on('click', '.toggle-schedule-day', function(e) {
         if ($(this).prop('checked')) {
            $(this).removeAttr('checked');
         } else {
            $(this).attr('checked', true);
         }

         const dayId = $(this).attr('data-id');
         let isScheduleDayActive = $(this).prop('checked') == true ? 1 : 0;

         let url = "{{ route('admin.appointment-schedule.update', '::day::') }}";
         url = url.replace('::day::', dayId);
         $.ajax({
            url,
            type: 'POST',
            data: {
               _method: 'PUT',
               _token: "{{ csrf_token() }}",
               isScheduleDayActive
            },
            success: function(response) {
               toastr.success(response.message, 'Success', {
                  "iconClass": 'toast-success'
               });
            },
            error: function(response) {
               toastr.error(response.message, 'Error', {
                  "iconClass": 'toast-error'
               });
            }
         })
      })

      function validateScheduleAndSetError(scheduleRow) {
         let isValid = true;

         const addErrorToInput = (element, errMessage) => {
            element.addClass("is-invalid");
            $("<div>").addClass("invalid-feedback").text(errMessage).insertAfter(element);
            isValid = false;
         };

         scheduleRow.find(".invalid-feedback").remove();
         scheduleRow.find("input").removeClass("is-invalid");

         const timeInput = scheduleRow.find("input");
         const time = timeInput.val();
         if (time == "") {
            const errMessage = "The time field is required.";
            addErrorToInput(timeInput, errMessage);
         }

         return isValid;
      }
   </script>
@endsection
