import React from 'react';
import TestLayout from "@/Layouts/TestLayout";
import { Link } from '@inertiajs/inertia-react';
import { Head } from "@inertiajs/inertia-react";

import { DataTable } from 'primereact/datatable';
import { Column } from 'primereact/column';
import { Button } from 'primereact/button';
import { Badge } from 'primereact/badge';
import { Toolbar } from 'primereact/toolbar';

import "primereact/resources/themes/lara-light-indigo/theme.css";  //theme
import "primereact/resources/primereact.min.css";                  //core css
import "primeicons/primeicons.css";                                //icons

function Index({ auth, alumnos}) {
    

     const statusBodyTemplate = (rowData) => {
        return <Badge   value={rowData.estatus} size="large" severity="warning"></Badge>
        //<span className={`customer-badge status-${rowData.estatus}`}>{rowData.estatus}</span>;
    }
    const actionBodyTemplate = (rowData) => {
        return (
            <React.Fragment>
                <Link href={route("alumno.edit", rowData.id)}>
                    <Button icon="pi pi-pencil" className="p-button-rounded p-button-success mr-2"/>
                </Link>
                
               
                <Button icon="pi pi-trash" className="p-button-rounded p-button-warning" onClick={() => confirmDeleteProduct(rowData)} />
            </React.Fragment>
        );
    }
    return (
        <TestLayout 
            auth={auth}
            header={
                <h2 >
                    Lista de Alumnos
                </h2>
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

            <Link href={route('alumno.create')} 
                method={'get'}
                as={'a'}
                className=' items-center px-4 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest active:bg-gray-900 transition ease-in-out duration-150'
            >
                Crear
            </Link>
            

            
            <DataTable value={alumnos} responsiveLayout="scroll" scrollable
                size="small" stripedRows filterDisplay="menu"
                paginator rows={10} rowsPerPageOptions={[5, 10, 25]}
                paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
            >
                <Column field="nombre" header="Nombre" sortable></Column>
                <Column field="apellido" header="Apellido" sortable></Column>
                <Column field="no_control" header="No. Control"></Column>
                <Column field="semestre" header="Semestre"></Column>
                <Column field="estatus" header="Estatus" body={statusBodyTemplate} sortable></Column>
                <Column field="carrera" header="Carrera"></Column>
                <Column body={actionBodyTemplate} exportable={false} style={{ minWidth: '8rem' }}></Column>
            </DataTable>
        </TestLayout>
    );
}

export default Index