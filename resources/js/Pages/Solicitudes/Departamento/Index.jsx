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

function Index({ auth, hasRole, solicitudes, departamento}) {
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
            href={route("solicitud.create")}
            method={"get"}
            as={"a"}
            className=" items-center px-4 py-3  bg-gray-900   hover:bg-gray-700 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest active:bg-gray-900 transition ease-in-out duration-150"
         >
            Crear Solicitud
         </Link>
      </div>
   );

   const statusBodyTemplate = (rowData) => {
        return (
            <span className=" bg-gray-200 rounded-md p-1 text-center text-gray-800 font-mono ">
            {rowData.estatus}
            </span>
        );
   };

   const actionBodyTemplate = (rowData) => {
      return (
         <React.Fragment>
            <Link href={route("solicitud.edit",rowData.id)} method="get" as="button"
               /* className={hasRole.solicitud_edit
                  ? "flex"
                  : "hidden"
               } */
            >
               <span className=  "bg-green-400 hover:bg-green-600 rounded-3xl p-2 m-3">
                  <i className="pi pi-pencil"></i>
               </span>
            </Link>
         </React.Fragment>
      );
   };

   
   return (
      <TestLayout
         auth={auth}
         header={<h1 className="mb-8 text-3xl font-bold">Solicitudes / {departamento}</h1>}
         hasRole ={hasRole}
      >
         <Head title="Solicitudes" />

         <DataTable
            value={solicitudes} responsiveLayout="scroll" scrollable dataKey='id'
            size="small" stripedRows globalFilter={globalFilter} header={header}
            paginator rows={10} rowsPerPageOptions={[5, 10, 25]} paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
         >
            <Column field="actividad" header="Actividad" sortable></Column>
            <Column field="alumno" header="Alumno"></Column>
            <Column field="alumno_ncontrol" header="No. Control"></Column>
            <Column field="valor" header="Valor" sortable></Column>
            <Column field="periodo" header="Periodo" sortable></Column>  
            <Column field="estatus" header="Estatus" body={statusBodyTemplate} sortable></Column>
            <Column body={actionBodyTemplate} exportable={false} style={{ minWidth: "6rem" }}></Column>
         </DataTable>
      </TestLayout>
   );
}

export default Index;
