import React from 'react';
import TestLayout from "@/Layouts/TestLayout";
import InputError from "@/Components/InputError";
import PrimaryButton from "@/Components/PrimaryButton";
import { Link } from '@inertiajs/inertia-react';
import InputLabel from '@/Components/InputLabel';
import { Dropdown } from "primereact/dropdown";
import { useForm, Head } from "@inertiajs/inertia-react";

function Edit({auth, hasRole, periodo, estatus}) {
    const { data, setData, patch, proccesing, reset, errors } = useForm({
        descripcion: periodo.descripcion,
        estatus_id: periodo.estatus_id,
    });

    const submit = (e) => {
        e.preventDefault();
        patch(route("periodo.update", periodo.id), { onSucces: () => reset() });
    };

    //Lista de estatus para seleccionar
    const statuslSelectItems = [];
    estatus.map((registro) =>{
   statuslSelectItems.push({label: registro.descripcion, value: registro.id})
  })
    return (
        <TestLayout 
            auth={auth}
            hasRole={hasRole}
            header={
                <h1 className="mb-8 text-3xl font-bold">
                   <Link
                    href={route('periodo.index')}
                    className="text-indigo-600 hover:text-indigo-700"
                   >
                      Periodo
                   </Link>
                   <span className="font-medium text-indigo-600"> /</span> {periodo.descripcion}
                </h1>
            }
        >
            <Head title="Periodos"/>
        

            
            <div className="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
                <form onSubmit={submit}>

                    <InputLabel forInput={data.descripcion}>Periodo</InputLabel>
                    <input 
                      value={data.descripcion}
                      onChange={e => setData('descripcion', e.target.value)}
                      type='text'
                      autoFocus
                      className="mb-3 block w-full border-gray-300 rounded-lg"
                      name="descripcion"
                    />
                    <InputError message={errors.descripcion} className="mt-2" />

                    <InputLabel forInput={data.estatus_id}>Estatus</InputLabel>
                    <Dropdown
                        
                        value={data.estatus_id}
                        options={statuslSelectItems}
                        onChange={(e) => setData("estatus_id", e.value)}
                        placeholder="Estatus"
                        className="w-full"
                    />
                    <InputError message={errors.estatus_id} className="mt-2" />

                 
                    
                    <Link href={route('periodo.index')} className="mt-4 font-semibold text-xs text-white bg-red-600 hover:bg-red-700 rounded-md mr-2 mb-2 px-4 py-2 uppercase">
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