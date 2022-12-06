import React from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import TestLayout from "@/Layouts/TestLayout";
import { Head } from "@inertiajs/inertia-react";

export default function Dashboard(props) {
    return (
        <TestLayout
            auth={props.auth}
            errors={props.errors}
            header={
                <h2  className="text-3xl font-bold">
                    Dashboard
                </h2>
            }
            hasRole={props.hasRole}
        >
            <Head title="Dashboard" />

            <div>
                
                {/* <h1 className="mb-8 text-3xl font-bold">Dashboard</h1> */}
                <p className="mb-8 leading-normal text-xl">
                    Sistema de Administración de Creditos Complementarios
                    
                </p>
            </div>
            {/* <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="mx-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 bg-white border-b border-gray-200">You're logged in!</div>
                    </div>
                </div>
            </div> */}
        </TestLayout>
    );
}
