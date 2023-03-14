import ApplicationLogo from '@/Components/ApplicationLogo';
import { Link } from '@inertiajs/react';
import NavLink from "@/Components/NavLink";

export default function Guest({ header, children }) {
    return (
        <div className="min-h-screen flex flex-col bg-gray-100">
            <nav className="bg-white border-b border-gray-100">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="flex justify-center h-16">
                        <div className="flex">
                            <div className="shrink-0 flex items-center">
                                <Link href="/">
                                    <ApplicationLogo className="block h-9 w-auto fill-current text-gray-800" />
                                </Link>
                            </div>

                            <div className="sm:absolute sm:top-0 sm:right-0 py-5 text-right">
                                <NavLink
                                    href={route('register')}
                                    className="ml-5 font-semibold text-gray-400 hover:text-gray-900"
                                >
                                    Generate E-Card
                                </NavLink>

                                <NavLink
                                    href={route('login')}
                                    className="ml-5 font-semibold text-gray-400 hover:text-gray-900"
                                >
                                    Log in
                                </NavLink>

                                <NavLink
                                    href={route('register')}
                                    className="mx-5 font-semibold text-gray-400 hover:text-gray-900"
                                >
                                    Register
                                </NavLink>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <div className="mt-auto flex sm:justify-center items-center sm:pt-0">
                <div className="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    {header && (
                        <header className="bg-white">
                            <div className="max-w-7xl mx-auto py-6 text-center">{header}</div>
                        </header>
                    )}
                    {children}
                </div>
            </div>


            <footer
                className="mt-auto bg-white text-center lg:text-left">
                <div className="p-4 text-center text-neutral-700">
                    © 2023 Copyright:
                    <a
                        className="text-neutral-800 dark:text-neutral-400"
                    > E-Card Generator App</a
                    >
                </div>
            </footer>

        </div>
    );
}
