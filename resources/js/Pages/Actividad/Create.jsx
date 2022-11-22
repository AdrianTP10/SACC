import React from 'react'
import TestLayout from "@/Layouts/TestLayout";
import InputError from "@/Components/InputError";
import PrimaryButton from "@/Components/PrimaryButton";
import { Link } from '@inertiajs/inertia-react';
import InputLabel from '@/Components/InputLabel';
import { Dropdown } from "primereact/dropdown";
import { useForm, Head } from "@inertiajs/inertia-react";

function Create({auth, estatus, departamentos}) {
  const { data, setData, post, proccesing, reset, errors } = useForm({
    descripcion: '',
    valor: '',
    estatus_id: '',
    departamento_id: '',
   });

   const submit = (e) => {
      e.preventDefault();
      //console.log(data)
      post(route("actividad.store"), { onSucces: () => reset() });
   };

   const statusSelectItems = [];
   estatus.map((registro) =>{
      statusSelectItems.push({label: registro.descripcion, value: registro.id})
   })

   const departmentSelectItems = [];
   departamentos.map((registro) =>{
      departmentSelectItems.push({label: registro.nombre, value: registro.id})
   })
 
   return (
      <TestLayout 
         auth={auth} 
         header={
            <h1 className="mb-8 text-3xl font-bold">
               <Link
                href={route('alumno.index')}
                className="text-indigo-600 hover:text-indigo-700"
               >
                  Actividades
               </Link>
               <span className="font-medium text-indigo-600"> /</span> Registro
            </h1>
         }
      >
         <Head title="Actividades" />
         <div className="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form onSubmit={submit}>
               <InputLabel forInput={data.descripcion}>Actividad</InputLabel>
               <input
                  value={data.descripcion}
                  onChange={(e) => setData("descripcion", e.target.value)}
                  type="text"
                  autoFocus
                  className="mb-3 block w-full border-gray-300 rounded-lg"
                  name="descripcion"
               />
               <InputError message={errors.descripcion} className="mt-2" />

               <InputLabel forInput={data.estatus_id}>Estatus</InputLabel>
               <Dropdown
                  value={data.estatus_id}
                  options={statusSelectItems}
                  onChange={(e) => setData("estatus_id", e.value)}
                  className='w-full'
               />
               <InputError message={errors.estatus_id} className="mt-2" />

               <InputLabel forInput={data.departamento_id}>Departamento</InputLabel>
                 <Dropdown
                    value={data.departamento_id}
                    options={departmentSelectItems}
                    onChange={(e) => setData("departamento_id", e.value)}
                    className='w-full' 
                 />
                 <InputError message={errors.departamento_id} className="mt-2" />

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


               <Link href={route('actividad.index')} className="mt-4 font-semibold text-xs text-white bg-red-600 hover:bg-red-700 rounded-md mr-2 mb-2 px-4 py-2 uppercase">
                        Cancelar
                    </Link>
               <PrimaryButton
                 className="mt-4 text-white bg-indigo-600 hover:bg-indigo-700 font-medium rounded-lg mr-2 mb-2"
                 disabled={proccesing}
               >
                  Registrar Actividad
               </PrimaryButton>
            </form>
         </div>
      </TestLayout>
   )
}

export default Create