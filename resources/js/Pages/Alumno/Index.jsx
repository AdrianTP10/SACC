import React from 'react';
import { useState } from 'react';
import TestLayout from "@/Layouts/TestLayout";
import { Link } from '@inertiajs/inertia-react';
import { Head } from "@inertiajs/inertia-react";
import TextInput from '@/Components/TextInput';

import { DataTable } from 'primereact/datatable';
import { Column } from 'primereact/column';
import { Button } from 'primereact/button';
import { InputText } from 'primereact/inputtext';
import { PrimeIcons } from 'primereact/api';
import { Badge } from 'primereact/badge';
import { Toolbar } from 'primereact/toolbar';

import "primereact/resources/themes/lara-light-indigo/theme.css";  //theme
import "primereact/resources/primereact.min.css";                  //core css
import "primeicons/primeicons.css";                                //icons

function Index({ auth,hasRole, alumnos}) {
    const [globalFilter, setGlobalFilter] = useState(null);

    const header = (
        <div className="table-header flex justify-between">
            <span className="p-input-icon-left">
                <i className="pi pi-search" />
                {/* <TextInput handleChange={(e) => setGlobalFilter(e.target.value)} ></TextInput> */}
                
                <InputText type="search" onInput={(e) => setGlobalFilter(e.target.value)} placeholder="Buscar..." />
            </span>

            
            <Link href={route('alumno.create')} 
                method={'get'}
                as={'a'}
                className=' items-center px-4 py-3  bg-gray-900   hover:bg-gray-700 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest active:bg-gray-900 transition ease-in-out duration-150'
            >
                Crear
            </Link>
        </div>
    );

    const statusBodyTemplate = (rowData) => {
        if(rowData.estatus == 'Activo'){
            return <span className=' bg-green-200 rounded-md p-1 text-center text-green-800 font-mono '>{rowData.estatus}</span>
        }
        return <span className=' bg-red-200 rounded-md p-1 text-center text-red-800 font-mono '>{rowData.estatus}</span>
    }
    const actionBodyTemplate = (rowData) => {
        return (
            <React.Fragment>
                <Link href={route("alumno.edit", rowData.id)} method='get' as='button' >
                    {/* <Button icon="pi pi-pencil" className="p-button-rounded p-button-success mr-2"/> */}
                    <span className='bg-green-400 hover:bg-green-600 rounded-3xl p-2 m-3'>
                        
                        <i className="pi pi-pencil"></i>
                       
                    </span>
                </Link>
                
                <Link href={route("alumno.destroy", rowData.id)} method='delete' as='button'>
                    {/* <Button icon="pi pi-trash" className="p-button-rounded p-button-warning"/> */}
                    <span className='bg-red-400 hover:bg-red-700 rounded-3xl p-2 m-3'>
                        <i className="pi pi-trash"></i>
                  
                    </span>
                </Link>
            </React.Fragment>
        );
    }
    return (
        <TestLayout 
            auth={auth}
            hasRole={hasRole}
            header={
                <h1 className="mb-8 text-3xl font-bold">
                    Alumnos
                </h1>
            }
        >
            <Head title="Alumnos" />
            {/* <Grid
                data= {personal}
                
                columns={['Nombre', 'Apellido', 'RFC']} 

                search={true}
                pagination={{
                    enabled: true,
                    limit: 10,
                }}
                
                width={'50%'}
            />  
            */}       
            
            <DataTable value={alumnos} responsiveLayout="scroll" scrollable dataKey='id'
                size="small" stripedRows  globalFilter={globalFilter} header={header}
                paginator rows={10} rowsPerPageOptions={[5, 10, 25]}
                paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
            >
                <Column field="nombre" header="Nombre" sortable></Column>
                <Column field="apellido" header="Apellido" sortable></Column>
                <Column field="no_control" header="No. Control"></Column>
                <Column field="semestre" header="Semestre"></Column>
                <Column field="estatus" header="Estatus" body={statusBodyTemplate} sortable></Column>
                <Column field="carrera" header="Carrera"></Column>
                <Column body={actionBodyTemplate} exportable={false} style={{ minWidth: '6rem' }}></Column>
            </DataTable>
        </TestLayout>
    );
}

export default Index