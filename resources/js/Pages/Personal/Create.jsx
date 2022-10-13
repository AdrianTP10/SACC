import React from "react";
import TestLayout from "@/Layouts/TestLayout";
import InputError from "@/Components/InputError";
import PrimaryButton from "@/Components/PrimaryButton";
import { useForm, Head } from "@inertiajs/inertia-react";

function Create({ auth }) {
    const { data, setData, post, proccesing, reset, errors } = useForm({
        nombre: "",
        apellido: "",
        rfc: "",
    });

    const submit = (e) => {
        e.preventDefault();
        post(route(personal.store), { onSucces: () => reset() });
    };
    return (
        <TestLayout auth={auth}>
            <Head title="Personal" />
            <div className="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
                <form onSubmit={submit}>
                    <label for="nombre">Nombre</label>
                    <input 
                      value={data.nombre}
                      onChange={e => setData('nombre', e.target.value)}
                      type='text'
                      autoFocus
                      className="mb-3 block w-full border-gray-300 rounded-lg"
                      name="nombre"
                    />
                    <InputError message={errors.title} className="mt-2" />

                    <label for="apellido">Apellido</label>
                    <input 
                      value={data.apellido}
                      onChange={e => setData('apellido', e.target.value)}
                      type='text'
                      autoFocus
                      className="mb-3 block w-full border-gray-300 rounded-lg"
                      name="apellido"
                    />
                    <InputError message={errors.title} className="mt-2" />

                    <label for="rfc">rfc</label>
                    <input 
                      value={data.rfc}
                      onChange={e => setData('rfc', e.target.value)}
                      type='text'
                      autoFocus
                      className="mb-3 block w-full border-gray-300 rounded-lg"
                      name="rfc"
                    />
                    <InputError message={errors.title} className="mt-2" />

                    <PrimaryButton
                        className="mt-4 text-white bg-indigo-600 hover:bg-indigo-700 font-medium rounded-lg mr-2 mb-2"
                        disabled={proccesing}
                    >
                        Crear
                    </PrimaryButton>
                </form>
            </div>
        </TestLayout>
    );
}

export default Create;