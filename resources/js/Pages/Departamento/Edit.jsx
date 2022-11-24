import React from 'react';
import TestLayout from "@/Layouts/TestLayout";
import InputError from "@/Components/InputError";
import PrimaryButton from "@/Components/PrimaryButton";
import { Link } from '@inertiajs/inertia-react';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/InputLabel';
import { Dropdown } from "primereact/dropdown";
import { useForm, Head } from "@inertiajs/inertia-react";

function Edit({auth,hasRole, departamento, personal}) {
    const { data, setData, patch, proccesing, reset, errors } = useForm({
        nombre: departamento.nombre,
        jefe_id: departamento.jefe_id,
      });
      
      const submit = (e) => {
        e.preventDefault();
        patch(route("departamento.update",departamento.id), { onSucces: () => reset() });
      };
      
      //Lista de personal para seleccionar
      const personalSelectItems = [];
      personal.map((registro) =>{
        personalSelectItems.push({label: (registro.nombre +' '+registro.apellido), value: registro.id})
      })
      
      return (
        <TestLayout 
          auth={auth} 
          hasRole={hasRole}
          header={
            <h1 className="mb-8 text-3xl font-bold">
              <Link
                href={route('departamento.index')}
                className="text-indigo-600 hover:text-indigo-700"
              >
                Departamentos
              </Link>
              <span className="font-medium text-indigo-600"> /</span> {departamento.nombre}
            </h1>
          }
        >
          <Head title="Departamentos" />
      
          <div className="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form onSubmit={submit}>
                <InputLabel forInput={data.nombre}>Departamento</InputLabel>
                <input
                    value={data.nombre}
                    onChange={(e) => setData("nombre", e.target.value)}
                    type="text"  
                    autoFocus
                    className="mb-3 block w-full border-gray-300 rounded-lg"
                    name="nombre"
                />
                <InputError message={errors.nombre} className="mt-2" />
      
                <InputLabel forInput={data.jefe_id}>Responsable</InputLabel>
                <Dropdown
                    value={data.jefe_id}
                    options={personalSelectItems}
                    onChange={(e) => setData("jefe_id", e.value)}
                    className="w-full"
                />
                <InputError message={errors.jefe_id} className="mt-2" />
        
    
                <Link href={route('departamento.index')} className="mt-4 font-semibold text-xs text-white bg-red-600 hover:bg-red-700 rounded-md mr-2 mb-2 p-2 uppercase">
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
      );
}

export default Edit