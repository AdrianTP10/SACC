import React from "react";
import TestLayout from "@/Layouts/TestLayout";
import InputError from "@/Components/InputError";
import PrimaryButton from "@/Components/PrimaryButton";
import { usePage } from '@inertiajs/inertia-react';
import { useForm, Head } from "@inertiajs/inertia-react";

function Index({ auth }) {
    return (
        <TestLayout auth={auth}>
            <Head title="Personal" />
            
        </TestLayout>
    );
}

export default Index;
