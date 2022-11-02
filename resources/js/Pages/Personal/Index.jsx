import React from "react";
import TestLayout from "@/Layouts/TestLayout";
import InputError from "@/Components/InputError";
import PrimaryButton from "@/Components/PrimaryButton";
import { Link } from '@inertiajs/inertia-react';
import { Head } from "@inertiajs/inertia-react";
/* import { Grid } from 'gridjs-react'; 
import "gridjs/dist/theme/mermaid.css";*/

import { DataTable } from 'primereact/datatable';
import { Column } from 'primereact/column';
import "primereact/resources/themes/lara-light-indigo/theme.css";  //theme
import "primereact/resources/primereact.min.css";                  //core css
import "primeicons/primeicons.css";                                //icons

function Index({ auth, personal}) {
    const leftToolbarTemplate = () => {
        return (
            <React.Fragment>
                <Button label="New" icon="pi pi-plus" className="p-button-success mr-2" onClick={openNew} />
                <Button label="Delete" icon="pi pi-trash" className="p-button-danger" onClick={confirmDeleteSelected} /* disabled={!selectedProducts || !selectedProducts.length} */ />
            </React.Fragment>
        )
    }

    return (
        <TestLayout 
            auth={auth}
            header={
                <h2 >
                    Personal
                </h2>
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

            <Link href={route('personal.create')} 
                method={'get'}
                as={'a'}
                className=' items-center px-4 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest active:bg-gray-900 transition ease-in-out duration-150'
            >
                Crear
            </Link>

            
            <DataTable value={personal} responsiveLayout="scroll" scrollable
                size="small" stripedRows filterDisplay="menu"
                paginator rows={10} rowsPerPageOptions={[5, 10, 25]}
                paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
            >
                <Column field="nombre" header="Nombre" sortable></Column>
                <Column field="apellido" header="Apellido" sortable></Column>
                <Column field="rfc" header="Rfc"></Column>
            </DataTable>
        </TestLayout>
    );
}

export default Index;
