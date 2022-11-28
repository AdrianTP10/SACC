import React from "react";
import { useState } from 'react';
import TestLayout from "@/Layouts/TestLayout";
import { Link } from '@inertiajs/inertia-react';
import { Head } from "@inertiajs/inertia-react";
import { DataTable } from 'primereact/datatable';
import { Column } from 'primereact/column';
import { InputText } from 'primereact/inputtext';
import { Page, Text, View, Document, StyleSheet, PDFViewer } from '@react-pdf/renderer';
import Pdf from "@/Layouts/Pdf";
import ReactPDF from '@react-pdf/renderer';

import "primereact/resources/themes/lara-light-indigo/theme.css";  //theme
import "primereact/resources/primereact.min.css";                  //core css
import "primeicons/primeicons.css";                                //icons

function VerSolicitudes({auth, hasRole ,solicitudes, alumno}) {
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
       </div>
    );
 
    const statusBodyTemplate = (rowData) => {
        return (
            <span className=" bg-green-200 rounded-md p-1 text-center text-green-800 font-mono ">
               {rowData.estatus}
            </span>
         );
    };
 
    
    return (
       <TestLayout
          auth={auth}
          header={
            <h1 className="mb-8 text-3xl font-bold">
                 <Link
                  href={route('actividad.index')}
                  className="text-indigo-600 hover:text-indigo-700"
                 >
                    Créditos
                 </Link>
                 <span className="font-medium text-indigo-600"> /</span> {alumno.nombre}
            </h1>
          }
          hasRole ={hasRole}
       >
          <Head title="Alumno" />
 
          <DataTable
             value={solicitudes} responsiveLayout="scroll" dataKey='id'
             globalFilter={globalFilter} header={header}
              rows={25} 
             
             size="small" stripedRows  resizableColumns columnResizeMode="fit" 
          >
               <Column field="actividad" header="Actividad" sortable style={{width:'25%'}}></Column>
                {/* <Column field="alumno" header="Alumno" style={{width:'25%'}}></Column> */}
               <Column field="departamento" header="Departamento" sortable style={{width:'25%'}}></Column>
               {/* <Column field="responsable" header="Responsable" style={{width:'15%'}}></Column> */}
               <Column field="periodo" header="Periodo" sortable style={{width:'10%'}}></Column>
               <Column field="valor" header="Valor" sortable style={{width:'10%'}}></Column>
               {/* <Column field="estatus" header="Estatus" body={statusBodyTemplate} sortable style={{width:'10%'}}></Column> */}
               
               {/* <Column field="calificacion" header="Calificacion" sortable style={{width:'10%'}}></Column> */}
          </DataTable>
          {/* <PDFViewer style={{width:"100%"}}>
            <Pdf/>
             
          </PDFViewer> */}
         
          
       </TestLayout>
    );
}

export default VerSolicitudes