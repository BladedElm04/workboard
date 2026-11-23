import { Head } from '@inertiajs/react';
import AppLayout from '../layouts/app-layout';
import type { SharedPageProps } from '../types/page-props';

type HomeProps = SharedPageProps;

export default function Home({ appName }: HomeProps) {
    return (
        <AppLayout>
            <Head title="Home" />

            <section className="space-y-3">
                <p className="text-sm font-semibold uppercase tracking-wide text-indigo-600">
                    {appName}
                </p>

                <h1 className="text-3xl font-semibold tracking-tight text-slate-900">
                    Welcome to WorkBoard
                </h1>

                <p className="max-w-2xl text-base leading-7 text-slate-600">
                    Your workspace for organizing projects, coordinating tasks, and
                    keeping your team on track.
                </p>
            </section>
        </AppLayout>
    );
}
