import React from 'react'
import TestLayout from "@/Layouts/TestLayout";
import InputError from "@/Components/InputError";
import PrimaryButton from "@/Components/PrimaryButton";
import { Link } from '@inertiajs/inertia-react';
import InputLabel from '@/Components/InputLabel';
import { Dropdown } from "primereact/dropdown";
import { useForm, Head } from "@inertiajs/inertia-react";

function Edit({auth, can,personal}) {
    const { data, setData, patch, proccesing, reset, errors } = useForm({
        nombre: personal.nombre,
        apellido: personal.apellido,
        rfc: personal.rfc,
     });
    
       const submit = (e) => {
          e.preventDefault();
          //console.log(data)
          patch(route("personal.update",personal.id), { onSucces: () => reset() });
       };
    
       return (
          <TestLayout 
             auth={auth} 
             header={
                <h1 className="mb-8 text-3xl font-bold">
                   <Link
                    href={route('personal.index')}
                    className="text-indigo-600 hover:text-indigo-700"
                   >
                      Personal
                   </Link>
                   <span className="font-medium text-indigo-600"> /</span> {personal.nombre}
                </h1>
           }
          >
             <Head title="Personal" />
             <div className="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
                <form onSubmit={submit}>
                    <InputLabel forInput={data.nombre}>Nombre</InputLabel>
                    <input 
                      value={data.nombre}
                      onChange={e => setData('nombre', e.target.value)}
                      type='text'
                      autoFocus
                      className="mb-3 block w-full border-gray-300 rounded-lg"
                      name="nombre"
                    />
                    <InputError message={errors.nombre} className="mt-2" />

                    <InputLabel forInput={data.apellido}>Apellido</InputLabel>
                    <input 
                      value={data.apellido}
                      onChange={e => setData('apellido', e.target.value)}
                      type='text'
                      autoFocus
                      className="mb-3 block w-full border-gray-300 rounded-lg"
                      name="apellido"
                    />
                    <InputError message={errors.apellido} className="mt-2" />

                    <InputLabel forInput={data.rfc}>Rfc</InputLabel>
                    <input 
                      value={data.rfc}
                      onChange={e => setData('rfc', e.target.value)}
                      type='text'
                      autoFocus
                      className="mb-3 block w-full border-gray-300 rounded-lg"
                      name="rfc"
                    />
                    <InputError message={errors.rfc} className="mt-2" />
    
    
                   <Link href={route('personal.index')} className="mt-4 font-semibold text-xs text-white bg-red-600 hover:bg-red-700 rounded-md mr-2 mb-2 px-4 py-2 uppercase">
                        Cancelar
                    </Link>
                   <PrimaryButton
                     className="mt-4 text-white bg-indigo-600 hover:bg-indigo-700 font-medium rounded-lg mr-2 mb-2"
                     disabled={proccesing}
                   >
                      Guardar
                   </PrimaryButton>
                </form>
             </div>
          </TestLayout>
       )
}

export default Edit