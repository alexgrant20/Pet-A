@extends('layouts.master.layout')

@section('title', 'Home')

@section('content')
   @if (auth()->user()->hasRole(RoleInterface::ROLE_ADMIN))
      <div class="h-screen">
         <div class="flex gap-5 sm:flex-row flex-col my-5">
            <div class="card rounded-2xl shadow-xl bg-white opacity-85 w-56">
               <div class="card-body">
                  <div class="flex flex-row items-center text-wrap">
                     <i class="fa-solid fa-user text-primary"></i>
                     <div class="text-md font-bold ml-2">Pet Owner</div>
                  </div>
                  <div class="font-bold text-4xl">{{ $petOwnerCount }}</div>
               </div>
            </div>
            <div class="card rounded-2xl shadow-xl bg-white opacity-85 w-56">
               <div class="card-body">
                  <div class="flex flex-row items-center text-wrap">
                     <i class="fa-solid fa-hospital text-primary"></i>
                     <div class="text-md font-bold ml-2">Clinic</div>
                  </div>
                  <div class="font-bold text-4xl">{{ $clinicCount }}</div>
               </div>
            </div>
            <div class="card rounded-2xl shadow-xl bg-white opacity-85 w-56">
               <div class="card-body">
                  <div class="flex flex-row items-center text-wrap">
                     <i class="fa-solid fa-user-doctor text-primary"></i>
                     <div class="text-md font-bold ml-2">Veterinarian</div>
                  </div>
                  <div class="font-bold text-4xl">{{ $veterinarianCount }}</div>
               </div>
            </div>
            <div class="card rounded-2xl shadow-xl bg-white opacity-85 w-56">
               <div class="card-body">
                  <div class="flex flex-row items-center text-wrap">
                     <i class="fa-solid fa-user-doctor text-primary"></i>
                     <div class="text-md font-bold ml-2">Active Appointment</div>
                  </div>
                  <div class="font-bold text-4xl">{{ $activeAppointments->count() }}</div>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-body p-4 bg-white/35 shadow-xl rounded-xl">
               <div class="flex justify-between items-center mb-2 w-full">
                  <div class="text-gray-600">
                     <span class="me-1 text-lg font-bold">Appointments Chart</span>
                  </div>
               </div>
               <div class="w-full overflow-x-auto h-full">
                  <div class="w-full h-full">
                     <canvas class="w-0 h-full max-h-52" id="acquisitions"></canvas>
                  </div>
               </div>
            </div>
         </div>
      </div>
   @elseif (auth()->user()->hasRole(RoleInterface::ROLE_VETERINARIAN))
      <div class="flex gap-5">
         <div class="w-full">
            <div class="mt-3 flex">
               <h1 class="font-bold text-xl">Hello {{ auth()->user()->name }},</h1>
               <h2 class="ml-2 align-bottom">You have {{ $totalTodayAppointment }} appointments today</h2>
            </div>
            <div class="flex my-5">
               <div class="card rounded-2xl shadow-xl bg-white opacity-85">
                  <div class="card-body">
                     <div class="flex flex-row text-wrap">
                        <img src="{{ asset('assets/dog-paw.svg') }}" class="w-4 text-primary">
                        <div class="text-md font-bold ml-2">Upcoming Appointment</div>
                     </div>
                     <div class="font-bold text-4xl">{{ $activeAppointments->count() }}</div>
                  </div>
               </div>
               <div class="card rounded-2xl shadow-xl bg-white opacity-85 ml-5">
                  <div class="card-body">
                     <div class="flex flex-row text-wrap">
                        <img src="{{ asset('assets/dog-paw.svg') }}" class="w-4 text-primary">
                        <span class="text-md ml-2 font-bold">Finished Appointment</span>
                     </div>
                     <div>
                        <span class="font-bold text-4xl">{{ $totalFinishedAppointmentThisMonth }}</span>
                     </div>
                     @if ($totalFinishedAppointmentDifference != 0)
                        <div>
                           <span>
                              <i
                                 class="fa-solid {{ $differenceTotalAppointmentIcon }} text-{{ $differenceTotalAppointmentClass }}"></i>
                           </span>
                           <span class="text-{{ $differenceTotalAppointmentClass }} font-bold">
                              {{ number_format($totalFinishedAppointmentDifference, 2, '.', '') }}&percnt;
                           </span>
                           <span>from last month</span>
                        </div>
                     @endif
                  </div>
               </div>
            </div>

            <div class="card">
               <div class="card-body p-4 bg-white/35 shadow-xl rounded-xl">
                  <div class="flex justify-between items-center mb-2 w-full">
                     <div class="text-gray-600">
                        <span class="me-1 text-lg font-bold">Appointments Chart</span>
                     </div>
                  </div>
                  <div class="w-full overflow-x-auto h-full">
                     <div class="w-full h-full">
                        <canvas class="w-0 h-full max-h-52" id="acquisitions"></canvas>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="w-full">
            <div class="flex justify-between items-center mb-5 w-full">
               <span class="font-bold text-xl">Upcoming Appointment</span>
               <a href="{{ route('admin.appointment.index') }}" class="text-primary font-bold border-primary hover:border-b">
                  <span class="me-1 text-sm">See All</span>
                  <i class="fa-solid fa-chevron-right text-[0.7rem]"></i>
               </a>
            </div>
            <div class="grid grid-rows-2 gap-5">
               @forelse ($activeAppointments as $appointment)
                  <a href="{{ route('admin.appointment.show', $appointment->id) }}" class="card">
                     <div
                        class="card-body bg-white/65 shadow-xl rounded-xl flex-row p-0 gap-5 items-center justify-start border-2 border-transparent hover:border-primary group transition-all duration-300">
                        <div class="py-4 flex flex-col font-bold justify-center h-full">
                           <div class="px-8 border-r-2">
                              <span class="text-primary text-sm block">{{ $appointment->appointment_date->format('l') }}</span>
                              <span>{{ $appointment->appointment_date->format('M d, Y') }}</span>
                              <div class="flex items-center gap-2 text-sm mt-2">
                                 <i class="fa-solid fa-clock text-gray-400"></i>
                                 <span
                                    class="text-gray-700">{{ $appointment->appointmentSchedule->start_time->format('H:i') }}</span>
                              </div>
                           </div>
                        </div>
                        <div class="py-4 flex flex-col gap-2">
                           <div class="text-gray-900 font-semibold">
                              {{ $appointment->pet->name }}
                           </div>
                           <div class="badge badge-primary">
                              {{ $appointment->serviceType->name }}
                           </div>
                        </div>
                        <div class="ms-auto pe-4 text-transparent group-hover:text-primary duration-500">
                           <i class="fa-solid fa-arrow-right text-lg"></i>
                        </div>
                     </div>
                  </a>
               @empty
                  <div class="card">
                     <div
                        class="card-body border-2 border-primary border-dashed shadow rounded-xl gap-5 items-center justify-center p-5">
                        <i class="fa-solid fa-plus bg-primary bg-opacity-70 p-4 rounded-full text-white"></i>
                        <span class="font-bold text-gray-700">There is No Appointment Yet</span>
                     </div>
                  </div>
               @endforelse
            </div>
         </div>
      </div>
   @endif
@endsection

@section('js-footer')
   <script>
      (async function() {
         const totalConsultationAppointment = @json(@$totalConsultationAppointment);
         const totalVaccinationAppointment = @json(@$totalVaccinationAppointment);
         const appointmentConsultationTotal = [];
         const appointmentVaccinationTotal = [];

         Object.values(totalConsultationAppointment).forEach(function(data) {
            appointmentConsultationTotal.push(data.totalAppointment);
         });

         Object.values(totalVaccinationAppointment).forEach(function(data) {
            appointmentVaccinationTotal.push(data.totalAppointment);
         });

         const labels = Object.values(totalConsultationAppointment)
            .map(function(value) {
               const [year, month] = value.month.split('-');
               const dateLabel = new Date(year, month - 1);

               const formatedLabel = new Intl.DateTimeFormat('en', {
                  year: 'numeric',
                  month: 'short'
               }).format(dateLabel);

               return formatedLabel;
            });

         var ctx = document.getElementById('acquisitions').getContext('2d');

         new Chart(
            ctx, {
               type: 'line',
               data: {
                  labels,
                  datasets: [{
                        data: appointmentConsultationTotal,
                        label: "Consultation Appointment Total",
                        borderColor: "#58c0e3",
                        backgroundColor: '#58c0e3',
                        fill: false,
                        pointRadius: 3
                     },
                     {
                        data: appointmentVaccinationTotal,
                        label: "Vaccination Appointment Total",
                        borderColor: "#2ECC71",
                        backgroundColor: '#2ECC71',
                        fill: false,
                        pointRadius: 3
                     },
                  ]
               },
               options: {
                  maintainAspectRatio: false,
                  responsive: true,
                  plugins: {
                     legend: {
                        position: 'bottom', // Position legend at the bottom
                        labels: {
                           usePointStyle: true,

                        }
                     },
                  },
               }
            }
         );
      })();
   </script>

@endsection
