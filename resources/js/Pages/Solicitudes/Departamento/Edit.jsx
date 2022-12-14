import React from "react";
import TestLayout from "@/Layouts/TestLayout";
import InputError from "@/Components/InputError";
import PrimaryButton from "@/Components/PrimaryButton";
import { Link } from '@inertiajs/inertia-react';
import InputLabel from '@/Components/InputLabel';
import { InputText } from 'primereact/inputtext';
import { Dropdown } from "primereact/dropdown";
import { useForm, Head } from "@inertiajs/inertia-react";

function DepartamentoEdit({auth, hasRole,solicitud, estatus, actividades, periodos}) {
   const { data, setData, patch, proccesing, reset, errors } = useForm({
      actividad_id: solicitud.actividad_id,
      periodo_id: solicitud.periodo_id,
      estatus_id: solicitud.estatus_id,
      calificacion: '',
      valor: solicitud.valor,
   });

   const submit = (e) => {
      e.preventDefault();
      patch(route("solicitud.update", solicitud.id), { onSucces: () => reset() });
   };

   //Lista de estatus para seleccionar
   const statusSelectItems = [];
    estatus.map((registro) =>{
      statusSelectItems.push({label: registro.descripcion, value: registro.id})
   })
   
    
   //Lista de estatus para seleccionar
   const actividadSelectItems = [];
   actividades.map((registro) =>{
   actividadSelectItems.push({label: registro.descripcion, value: registro.id})
   })
   const periodoSelectItems = [];
   periodos.map((registro) =>{
      periodoSelectItems.push({label: registro.descripcion, value: registro.id})
   })


   return (
      <TestLayout 
        auth={auth} 
        hasRole={hasRole}
        header={
            <h1 className="mb-8 text-3xl font-bold">
            <Link
               href={route('departamento.solicitudes')}
               className="text-indigo-600 hover:text-indigo-700"
            >
               Evaluar Solicitud
            </Link>
            <span className="font-medium text-indigo-600"> /</span> {solicitud.id}
            </h1>
        }
      >
        <Head title="Solicitud" />

         <div className="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form onSubmit={submit}>
               <InputLabel forInput={data.actividad_id}>Actividad</InputLabel>
               <Dropdown
                  value={data.actividad_id}
                  options={actividadSelectItems}
                  onChange={(e) => setData("actividad_id", e.value)}
                  className="w-full"
               />
               <InputError message={errors.actividad_id} className="mt-2" />

               <InputLabel forInput={data.periodo_id}>Periodo</InputLabel>
               <Dropdown
                  value={data.periodo_id}
                  options={periodoSelectItems}
                  onChange={(e) => setData("periodo_id", e.value)}
                  className="w-full"
               />
               <InputError message={errors.periodo_id} className="mt-2" />
               
            

               <InputLabel>No. de Control</InputLabel>
               <input 
                  type="text" 
                  value={solicitud.no_control} 
                  className="mb-3 block w-full border-gray-300 rounded-lg text-indigo-600"disabled
               />
               
               <InputLabel>Responsable</InputLabel>
               <input 
                  type="text" 
                  value={solicitud.responsable} 
                  className="mb-3 block w-full border-gray-300 rounded-lg text-indigo-600"disabled
               />

               <InputLabel forInput={data.valor}>Valor</InputLabel>
               <input
                  value={data.valor}
                  onChange={(e) => setData("valor", e.target.value)}
                  type="number"
                        
                  autoFocus
                  className="mb-3 block w-full border-gray-300 rounded-lg"
                  name="no_control"
               />
               <InputError message={errors.valor} className="mt-2" />
                
      
               <InputLabel forInput={data.estatus_id}>Estatus</InputLabel>
               <Dropdown 
                  value={data.estatus_id}
                  options={statusSelectItems}
                  onChange={(e) => setData("estatus_id", e.value)}
                  className="w-full"
               />
               <InputError message={errors.title} className="mt-2" />
      
               <InputLabel forInput={data.estatus_id}>Calificacion</InputLabel>
               <input
                  value={data.calificacion}
                  onChange={(e) => setData("calificacion", e.target.value)}
                  type="text"
                  autoFocus
                  className="mb-3 block w-full border-gray-300 rounded-lg"
                  name="calificaion"
               />
               <InputError message={errors.calificacion} className="mt-2" />
      
                  
      
      
               <Link href={route('departamento.solicitudes')} className="mt-4 font-semibold text-xs text-white bg-red-600 hover:bg-red-700 rounded-md mr-2 mb-2 p-2 uppercase">
                  Cancelar
               </Link>
               <PrimaryButton
                  className="mt-4 text-white bg-indigo-600 hover:bg-indigo-700 font-medium rounded-lg mr-2 mb-2"
                  disabled={proccesing}
               >
                  Registrar Solicitud
               </PrimaryButton>
            </form>
         </div>
      </TestLayout>
   );
}

export default DepartamentoEdit;