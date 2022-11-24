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

function MisSolicitudes({ auth, solicitudes, can }) {
   console.log(can)
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
      switch (rowData.estatus) {
         case 'Registrado':
            return (
               <span className=" bg-gray-200 rounded-md p-1 text-center text-gray-800 font-mono ">
                  {rowData.estatus}
               </span>
            );

         case 'Aceptado':
            return (
               <span className=" bg-blue-200 rounded-md p-1 text-center text-blue-800 font-mono ">
                  {rowData.estatus}
               </span>
            );
         case 'Acreditado':
            return (
               <span className=" bg-green-200 rounded-md p-1 text-center text-green-800 font-mono ">
                  {rowData.estatus}
               </span>
            );
         default:
            return (
               <span className=" bg-red-200 rounded-md p-1 text-center text-red-800 font-mono ">
                  {rowData.estatus}
               </span>
            );
      }
   };

   return (
      <TestLayout
         auth={auth}
         header={<h1 className="mb-8 text-3xl font-bold">Mis Solicitudes</h1>}
         can ={can}
      >
         <Head title="Solicitudes" />

         <DataTable
            value={solicitudes} responsiveLayout="scroll" scrollable dataKey='id'
            size="small" stripedRows globalFilter={globalFilter} header={header}
            paginator rows={10} rowsPerPageOptions={[5, 10, 25]} paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
         >
            <Column field="actividad" header="Actividad" sortable></Column>
            <Column field="periodo" header="Periodo" sortable></Column>
            <Column field="valor" header="Valor" sortable></Column>
            <Column field="departamento" header="Departamento" sortable></Column>
            
            <Column field="estatus" header="Estatus" body={statusBodyTemplate} sortable></Column>
         </DataTable>
      </TestLayout>
   );
}

export default MisSolicitudes;
