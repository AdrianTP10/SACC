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

import "primereact/resources/themes/lara-light-indigo/theme.css";  //theme
import "primereact/resources/primereact.min.css";                  //core css
import "primeicons/primeicons.css";                                //icons

function Index({ auth,hasRole,personal}) {
    
    const [globalFilter, setGlobalFilter] = useState(null);

    const header = (
        <div className="table-header flex justify-between">
            <span className="p-input-icon-left">
                <i className="pi pi-search" />
                {/* <TextInput handleChange={(e) => setGlobalFilter(e.target.value)} ></TextInput> */}
                
                <InputText type="search" onInput={(e) => setGlobalFilter(e.target.value)} placeholder="Buscar..." />
            </span>
            
        </div>
    );

    return (
        <TestLayout 
            auth={auth}
            hasRole={hasRole}
            header={
                <h1 className="mb-8 text-3xl font-bold">
                    Personal
                </h1>
            }
        >
            <Head title="Personal" />
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

            
            <DataTable value={personal} responsiveLayout="scroll" scrollable
                globalFilter={globalFilter} header={header}
                size="small" stripedRows  resizableColumns columnResizeMode="fit" 
                paginator rows={10} rowsPerPageOptions={[5, 10, 25]}
                paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
            >
                <Column field="nombre" header="Nombre" sortable></Column>
                <Column field="apellido" header="Apellido" sortable></Column>
                <Column field="rfc" header="Rfc" style={{width:'10%'}}></Column>
            </DataTable>
        </TestLayout>
    );
}

export default Index;
