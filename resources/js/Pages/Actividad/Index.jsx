import React from "react";
import { useState } from 'react';
import TestLayout from "@/Layouts/TestLayout";
import { Link } from '@inertiajs/inertia-react';
import { Head } from "@inertiajs/inertia-react";
import { DataTable } from 'primereact/datatable';
import { Column } from 'primereact/column';
import { InputText } from 'primereact/inputtext';

import "primereact/resources/themes/lara-light-indigo/theme.css";  //theme
import "primereact/resources/primereact.min.css";                  //core css
import "primeicons/primeicons.css";                                //icons

function Index({ auth, actividades}) {
    const [globalFilter, setGlobalFilter] = useState(null);
    const header = (
        <div className="table-header flex justify-between">
           <span className="p-input-icon-left">
              <i className="pi pi-search" />
              <InputText
                 type="search"
                 onInput={(e) => setGlobalFilter(e.target.value)}
                 placeholder="Buscar..."
              />
           </span>
  
           <Link
              href={route("actividad.create")}
              method={"get"}
              as={"a"}
              className=" items-center px-4 py-3  bg-gray-900   hover:bg-gray-700 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest active:bg-gray-900 transition ease-in-out duration-150"
           >
              Crear Actividad
           </Link>
        </div>
     );
    const actionBodyTemplate = (rowData) => {
        return (
           <React.Fragment>
              <Link href={route("actividad.edit",rowData.id)} method="get" as="button">
                 <span className="bg-green-400 hover:bg-green-600 rounded-3xl p-2 m-3">
                    <i className="pi pi-pencil"></i>
                 </span>
              </Link>
  
              <Link href={route("actividad.destroy", rowData.id)} method="delete" as="button">
                 <span className="bg-red-400 hover:bg-red-700 rounded-3xl p-2 m-3">
                    <i className="pi pi-trash"></i>
                 </span>
              </Link>
           </React.Fragment>
        );
     };
    return (
        <TestLayout 
            auth={auth}
            header={
                <h1 className="mb-8 text-3xl font-bold">Actividades</h1>
            }
        >
            <Head title="Actividades" />
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
            

            
            <DataTable 
                value={actividades} responsiveLayout="scroll" scrollable dataKey='id'
                size="small" stripedRows globalFilter={globalFilter} header={header}
                paginator rows={10} rowsPerPageOptions={[5, 10, 25]}
                paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
            >
                <Column field="descripcion" header="Actividad" sortable></Column>
                <Column field="valor_curricular" header="Valor" sortable></Column>
                <Column field="estatus" header="Estatus"></Column>
                <Column body={actionBodyTemplate} exportable={false} style={{ minWidth: "6rem" }}></Column>
            </DataTable>
        </TestLayout>
    );
}

export default Index