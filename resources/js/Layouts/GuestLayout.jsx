import { useState } from 'react';
import ApplicationLogo from '@/Components/ApplicationLogo';
import { Link } from '@inertiajs/react';
import NavLink from "@/Components/NavLink";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink";

export default function Guest({ header, children }) {
    const [showingNavigationDropdown, setShowingNavigationDropdown] = useState(false);

    return (
        <div className="min-h-screen flex flex-col bg-gray-100">
            <nav className="bg-white shadow border-b-2 border-indigo-200">
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
                                    className="font-semibold text-gray-400 hover:text-gray-900 hidden md:inline-flex"
                                >
                                    Generate E-Card
                                </NavLink>

                                <NavLink
                                    href={route('login')}
                                    className="ml-10 font-semibold text-gray-400 hover:text-gray-900 hidden sm:inline-flex"
                                >
                                    Log in
                                </NavLink>

                                <NavLink
                                    href={route('register')}
                                    className="mx-10 font-semibold text-gray-400 hover:text-gray-900 hidden sm:inline-flex"
                                >
                                    Register
                                </NavLink>
                            </div>
                        </div>

                        <div className="absolute py-3.5 mr-5 right-0 text-right sm:hidden">
                            <button
                                onClick={() => setShowingNavigationDropdown((previousState) => !previousState)}
                                className="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg className="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        className={!showingNavigationDropdown ? 'inline-flex' : 'hidden'}
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        className={showingNavigationDropdown ? 'inline-flex' : 'hidden'}
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div className={(showingNavigationDropdown ? 'block' : 'hidden') + ' sm:hidden'}>
                    <div className="pt-2 pb-3 border-b border-gray-200">

                        <div className="mt-3 border-t-4 border-gray-300 space-y-2">
                            <ResponsiveNavLink>Generate E-Card</ResponsiveNavLink>
                            <ResponsiveNavLink href={route('login')}>Login</ResponsiveNavLink>
                            <ResponsiveNavLink href={route('register')}>Register</ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <div className="mt-auto flex sm:justify-center items-center sm:pt-0">
                <div className="w-full sm:max-w-lg px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    {header && (
                        <header className="bg-white">
                            <div className="mx-auto py-6 text-center">{header}</div>
                        </header>
                    )}
                    {children}
                </div>
            </div>

            <footer className="mt-auto bg-white text-center lg:text-left shadow border-t-2 border-indigo-200">
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
