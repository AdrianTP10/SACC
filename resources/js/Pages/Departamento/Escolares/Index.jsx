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

function Index({ auth,hasRole, departamentos, can }) {
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

   return (
      <TestLayout
            auth={auth}
            hasRole={hasRole}
            header={<h1 className="mb-8 text-3xl font-bold">Departamentos</h1>}
            can ={can}
        >
            <Head title="Departamentos" />

            <DataTable
                value={departamentos} responsiveLayout="scroll" scrollable dataKey='id'
                size="small" stripedRows globalFilter={globalFilter} header={header}
                paginator rows={10} rowsPerPageOptions={[5, 10, 25]} paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
            >
                <Column field="nombre" header="Nombre" sortable ></Column>
                <Column field="jefe" header="Jefe de Departamento" ></Column>  
            </DataTable>
      </TestLayout>
   );
}

export default Index;