import React from "react";
import TestLayout from "@/Layouts/TestLayout";
import InputError from "@/Components/InputError";
import PrimaryButton from "@/Components/PrimaryButton";
import { Link } from '@inertiajs/inertia-react';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/InputLabel';
import { Dropdown } from "primereact/dropdown";
import { useForm, Head } from "@inertiajs/inertia-react";

function Edit({ auth,hasRole, alumno, lista_estatus, lista_carreras }) {
    const { data, setData, patch, proccesing, reset, errors } = useForm({
        nombre: alumno.nombre,
        apellido: alumno.apellido,
        no_control: alumno.no_control,
        semestre: alumno.semestre,
        estatus_id: alumno.estatus_id,
        carrera_id: alumno.carrera_id,
    });

    const submit = (e) => {
        e.preventDefault();
        patch(route("alumno.update", alumno.id), { onSucces: () => reset() });
    };

    //Lista de estatus para seleccionar
    const statusSelectItems = [];
    lista_estatus.map((registro) =>{
        statusSelectItems.push({label: registro.descripcion, value: registro.id})
    })

     //Lista de carreras para seleccionar
    const carrerasSelectItems = [];
    lista_carreras.map((registro) =>{
      carrerasSelectItems.push({label: registro.nombre, value: registro.id})
    })
    
    
    return (
        <TestLayout 
            auth={auth} 
            hasRole={hasRole}
            header={
                <h1 className="mb-8 text-3xl font-bold">
                <Link
                    href={route('alumno.index')}
                    className="text-indigo-600 hover:text-indigo-700"
                >
                    Alumnos
                </Link>
                <span className="font-medium text-indigo-600"> /</span> {alumno.nombre}
            </h1>
            }
        >
            <Head title="Alumnos" />

            <div className="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
                <form onSubmit={submit}>
                    <InputLabel forInput={data.nombre}>Nombre</InputLabel>
                    <input
                        value={data.nombre}
                        onChange={(e) => setData("nombre", e.target.value)}
                        type="text"
                        autoFocus
                        className="mb-3 block w-full border-gray-300 rounded-lg"
                        name="nombre"
                    />
                    <InputError message={errors.nombre} className="mt-2" />

                    <InputLabel forInput={data.apellido}>Apellido</InputLabel>
                    
                    <input
                        value={data.apellido}
                        onChange={(e) => setData("apellido", e.target.value)}
                        type="text"
                        autoFocus
                        className="mb-3 block w-full border-gray-300 rounded-lg"
                        name="apellido"
                    />
                    <InputError message={errors.apellido} className="mt-2" />

                    <InputLabel forInput={data.no_control}>No. Control</InputLabel>
                    <input
                        value={data.no_control}
                        onChange={(e) => setData("no_control", e.target.value)}
                        type="text"
                        autoFocus
                        className="mb-3 block w-full border-gray-300 rounded-lg"
                        name="no_control"
                    />
                    <InputError message={errors.no_control} className="mt-2" />

                    <InputLabel forInput={data.estatus_id}>Estatus</InputLabel>
                    <Dropdown
                        
                        value={data.estatus_id}
                        options={statusSelectItems}
                        onChange={(e) => setData("estatus_id", e.value)}
                        placeholder="Estatus"
                        className="w-full"
                    />
                    <InputError message={errors.title} className="mt-2" />

                    <InputLabel forInput={data.semestre}>Semestre</InputLabel>
                    <input
                        value={data.semestre}
                        onChange={(e) => setData("semestre", e.target.value)}
                        type="number"
                        min="1" max="12"
                        autoFocus
                        className="mb-3 block w-full border-gray-300 rounded-lg"
                        name="semestre"
                    />
                    <InputError message={errors.semestre} className="mt-2" />

                    <InputLabel forInput={data.carrera_id}>Carrera</InputLabel>
                    <Dropdown
                        value={data.carrera_id}
                        options={carrerasSelectItems}
                        onChange={(e) => setData("carrera_id", e.value)}
                        className='w-full'
                        
                    />
                    <InputError message={errors.carrera_id} className="mt-2" />


                    <Link href={route('alumno.index')} className="mt-4 font-semibold text-xs text-white bg-red-600 hover:bg-red-700 rounded-md mr-2 mb-2 px-4 py-2 uppercase">
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

export default Edit;
