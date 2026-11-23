import { Link } from '@inertiajs/react';
import type { PropsWithChildren } from 'react';

export default function AppLayout({ children }: PropsWithChildren) {
    return (
        <div className="min-h-screen bg-slate-50 text-slate-900">
            <header className="border-b border-slate-200 bg-white">
                <div className="mx-auto flex h-16 max-w-7xl items-center px-6">
                    <Link
                        href="/"
                        className="text-lg font-semibold tracking-tight text-slate-900"
                    >
                        WorkBoard
                    </Link>
                </div>
            </header>

            <main className="mx-auto w-full max-w-7xl px-6 py-10">
                {children}
            </main>
        </div>
    );
}
