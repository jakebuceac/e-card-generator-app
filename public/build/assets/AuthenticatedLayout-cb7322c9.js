import{r as s,j as e,a as t,F as f,d as p}from"./app-5d2b1de0.js";import{b as x,A as v,N as b,R as d}from"./background-c9c2257e.js";import{e as N}from"./transition-27752f68.js";const u=s.createContext(),c=({children:r})=>{const[o,n]=s.useState(!1),a=()=>{n(l=>!l)};return e(u.Provider,{value:{open:o,setOpen:n,toggleOpen:a},children:e("div",{className:"relative",children:r})})},y=({children:r})=>{const{open:o,setOpen:n,toggleOpen:a}=s.useContext(u);return t(f,{children:[e("div",{onClick:a,children:r}),o&&e("div",{className:"fixed inset-0 z-40",onClick:()=>n(!1)})]})},w=({align:r="right",width:o="48",contentClasses:n="py-1 bg-white",children:a})=>{const{open:l,setOpen:h}=s.useContext(u);let m="origin-top";r==="left"?m="origin-top-left left-0":r==="right"&&(m="origin-top-right right-0");let g="";return o==="48"&&(g="w-48"),e(f,{children:e(N,{as:s.Fragment,show:l,enter:"transition ease-out duration-200",enterFrom:"transform opacity-0 scale-95",enterTo:"transform opacity-100 scale-100",leave:"transition ease-in duration-75",leaveFrom:"transform opacity-100 scale-100",leaveTo:"transform opacity-0 scale-95",children:e("div",{className:`absolute z-50 mt-2 rounded-md shadow-lg ${m} ${g}`,onClick:()=>h(!1),children:e("div",{className:"rounded-md ring-1 ring-black ring-opacity-5 "+n,children:a})})})})},k=({className:r="",children:o,...n})=>e(p,{...n,className:"block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out "+r,children:o});c.Trigger=y;c.Content=w;c.Link=k;const i=c;function D({auth:r,mainClassName:o,children:n}){const[a,l]=s.useState(!1);return t("div",{className:"min-h-screen flex flex-col bg-auto bg-center",style:{backgroundImage:"url("+x+")"},children:[t("nav",{className:"bg-white shadow border-b-2 border-indigo-200",children:[e("div",{className:"max-w-7xl mx-auto px-4 sm:px-6 lg:px-8",children:t("div",{className:"flex justify-center h-16",children:[e("div",{className:"flex",children:e("div",{className:"shrink-0 flex items-center",children:e(p,{href:"/",children:e(v,{className:"block h-9 w-auto fill-current text-gray-800"})})})}),e("div",{className:"hidden md:flex sm:absolute sm:top-0 sm:right-0 sm:items-center py-4 text-right",children:t("div",{className:"inline-flex",children:[e(b,{href:route("e-card.generation.create"),className:"font-semibold text-gray-400 hover:text-gray-900 hidden sm:inline-flex",children:"Generate E-Card"}),t(i,{children:[e(i.Trigger,{children:e("span",{className:" mx-10 rounded-md",children:t("button",{type:"button",className:"inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-semibold text-gray-500 rounded-md bg-white hover:text-gray-900 focus:outline-none transition ease-in-out duration-150",children:[r.user.name,e("svg",{className:"ml-2 -mr-0.5 h-4 w-4",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",fill:"currentColor",children:e("path",{fillRule:"evenodd",d:"M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z",clipRule:"evenodd"})})]})})}),t(i.Content,{children:[e(i.Link,{href:route("dashboard"),children:"Your E-Cards"}),e(i.Link,{href:route("profile.edit"),children:"Profile"}),e(i.Link,{href:route("logout"),method:"post",as:"button",children:"Log Out"})]})]})]})}),e("div",{className:"absolute py-3.5 mr-5 right-0 text-right md:hidden",children:e("button",{onClick:()=>l(h=>!h),className:"inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out",children:t("svg",{className:"h-6 w-6",stroke:"currentColor",fill:"none",viewBox:"0 0 24 24",children:[e("path",{className:a?"hidden":"inline-flex",strokeLinecap:"round",strokeLinejoin:"round",strokeWidth:"2",d:"M4 6h16M4 12h16M4 18h16"}),e("path",{className:a?"inline-flex":"hidden",strokeLinecap:"round",strokeLinejoin:"round",strokeWidth:"2",d:"M6 18L18 6M6 6l12 12"})]})})})]})}),e("div",{className:(a?"block":"hidden")+" md:hidden",children:t("div",{className:"pt-2 pb-3 border-b border-gray-200",children:[t("div",{className:"px-4",children:[e("div",{className:"font-medium text-base text-gray-800",children:r.user.name}),e("div",{className:"font-medium text-sm text-gray-500",children:r.user.email})]}),t("div",{className:"mt-3 border-t-4 border-gray-300 space-y-2",children:[e(d,{href:route("e-card.generation.create"),children:"Generate E-Card"}),e(d,{href:route("dashboard"),children:"Your E-Cards"}),e(d,{href:route("profile.edit"),children:"Profile"}),e(d,{method:"post",href:route("logout"),as:"button",children:"Log Out"})]})]})})]}),o?e("main",{className:o,children:n}):e("main",{children:n}),e("footer",{className:"mt-auto bg-white text-center lg:text-left shadow border-t-2 border-indigo-200",children:t("div",{className:"p-4 text-center text-neutral-700",children:["© 2023 Copyright:",e("a",{className:"text-neutral-800 dark:text-neutral-400",children:" E-Card Generator App"})]})})]})}export{D as A};
