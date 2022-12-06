import React from 'react'
import TestLayout from "@/Layouts/TestLayout";
import InputError from "@/Components/InputError";
import PrimaryButton from "@/Components/PrimaryButton";
import { Link } from '@inertiajs/inertia-react';
import InputLabel from '@/Components/InputLabel';
import { Dropdown } from "primereact/dropdown";
import { useForm, Head } from "@inertiajs/inertia-react";

function Create({auth, hasRole, actividades, periodos}) {
  const { data, setData, post, proccesing, reset, errors } = useForm({
    actividad_id: '',
    periodo_id: '',
  });
  
  const submit = (e) => {
    e.preventDefault();
    post(route("solicitud.store"), { onSucces: () => reset() });
  };
  

   //Lista de estatus para seleccionar
  const actividadSelectItems = [];
  actividades.map((registro) =>{
    actividadSelectItems.push({label: registro.descripcion, value: registro.id})
  })
      
  const periodoSelectItems = [];
  periodos.map((registro) =>{
    periodoSelectItems.push({label: registro.descripcion, value: registro.id})
  })

  const activityOptionTemplate = (option) => {
    return (
      <div className="flex flex-col">
        <h1>{option.descripcion}</h1>
        <h1 className='font-light px-2'>{option.departamento}</h1>
        <h1 className='font-light px-2'>Valor: {option.valor} | Mis Créditos: {option.suma}</h1>
      </div>
    );
}
  
  return (
    <TestLayout 
      auth={auth} 
      hasRole={hasRole}
      header={
        <h1 className="mb-8 text-3xl font-bold">
          <Link
            href={route('alumno.solicitudes')}
            className="text-indigo-600 hover:text-indigo-700"
          >
            Solicitudes
          </Link>
          <span className="font-medium text-indigo-600"> /</span> Registro
        </h1>
      }
    >
      <Head title="Solicitud" />
  
      <div className="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form onSubmit={submit}>
          <InputLabel forInput={data.actividad_id}>Actividad</InputLabel>
          <Dropdown 
            value={data.actividad_id} 
            options={actividades} 
            optionValue="id"
            optionLabel="descripcion" 
            onChange={(e) => setData("actividad_id", e.value)} 
            placeholder="Selecciona una Actividad"
            className="w-full"
            itemTemplate={activityOptionTemplate}
          />
          <InputError message={errors.actividad_id} className="mt-2" />
          
          {/* 
          <Dropdown
            value={data.actividad_id}
            options={actividadSelectItems}
            onChange={(e) => setData("actividad_id", e.value)}
            className="w-full"
          />
           */}

          <InputLabel forInput={data.periodo_id}>Periodo</InputLabel>
          <Dropdown
            value={data.periodo_id}
            options={periodoSelectItems}
            onChange={(e) => setData("periodo_id", e.value)}
            className="w-full"
          />
          <InputError message={errors.periodo_id} className="mt-2" />
  
                 
        
              
          <Link href={route('alumno.solicitudes',auth.user.id)} className="mt-4 font-semibold text-xs text-white bg-red-600 hover:bg-red-700 rounded-md mr-2 mb-2 p-2 uppercase">
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

export default Create