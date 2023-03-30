import{r as o,a as r,j as e,d as c}from"./app-5b810beb.js";import{b as h,A as m,N as a,R as i}from"./background-8b914473.js";function u({header:n,children:s}){const[t,d]=o.useState(!1);return r("div",{className:"min-h-screen flex flex-col bg-auto bg-center",style:{backgroundImage:"url("+h+")"},children:[r("nav",{className:"bg-white shadow border-b-2 border-indigo-200",children:[e("div",{className:"max-w-7xl mx-auto px-4 sm:px-6 lg:px-8",children:r("div",{className:"flex justify-center h-16",children:[r("div",{className:"flex",children:[e("div",{className:"shrink-0 flex items-center",children:e(c,{href:"/",children:e(m,{className:"block h-9 w-auto fill-current text-gray-800"})})}),r("div",{className:"sm:absolute sm:top-0 sm:right-0 py-5 text-right",children:[e(a,{href:route("e-card.generation.create"),className:"font-semibold text-gray-400 hover:text-gray-900 hidden md:inline-flex",children:"Generate E-Card"}),e(a,{href:route("login"),className:"ml-10 font-semibold text-gray-400 hover:text-gray-900 hidden md:inline-flex",children:"Log in"}),e(a,{href:route("register"),className:"mx-10 font-semibold text-gray-400 hover:text-gray-900 hidden md:inline-flex",children:"Register"})]})]}),e("div",{className:"absolute py-3.5 mr-5 right-0 text-right md:hidden",children:e("button",{onClick:()=>d(l=>!l),className:"inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out",children:r("svg",{className:"h-6 w-6",stroke:"currentColor",fill:"none",viewBox:"0 0 24 24",children:[e("path",{className:t?"hidden":"inline-flex",strokeLinecap:"round",strokeLinejoin:"round",strokeWidth:"2",d:"M4 6h16M4 12h16M4 18h16"}),e("path",{className:t?"inline-flex":"hidden",strokeLinecap:"round",strokeLinejoin:"round",strokeWidth:"2",d:"M6 18L18 6M6 6l12 12"})]})})})]})}),e("div",{className:(t?"block":"hidden")+" sm:hidden",children:e("div",{className:"pt-2 pb-3 border-b border-gray-200",children:r("div",{className:"mt-3 border-t-4 border-gray-300 space-y-2",children:[e(i,{href:route("e-card.generation.create"),children:"Generate E-Card"}),e(i,{href:route("login"),children:"Login"}),e(i,{href:route("register"),children:"Register"})]})})})]}),e("div",{className:"mt-auto flex sm:justify-center items-center sm:pt-0",children:r("div",{className:"w-full sm:max-w-lg px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg",children:[n&&e("header",{className:"bg-white",children:e("div",{className:"mx-auto py-6 text-center",children:n})}),s]})}),e("footer",{className:"mt-auto bg-white text-center lg:text-left shadow border-t-2 border-indigo-200",children:r("div",{className:"p-4 text-center text-neutral-700",children:["© 2023 Copyright:",e("a",{className:"text-neutral-800 dark:text-neutral-400",children:" E-Card Generator App"})]})})]})}export{u as G};
