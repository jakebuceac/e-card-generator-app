import{a,F as l,j as e,n as i,d as r}from"./app-820a01eb.js";import{A as m}from"./AuthenticatedLayout-50790028.js";import{G as c}from"./GuestLayout-450fd688.js";import{P as s}from"./PrimaryButton-04ba7ff8.js";import"./background-e2405ae4.js";import"./transition-7a2f9598.js";function p(t){return a(l,{children:[e(i,{title:"Welcome"}),t.auth.user?e(m,{auth:t.auth,mainClassName:"mt-auto flex sm:justify-center items-center sm:pt-0",children:a("div",{className:"m-auto w-full sm:max-w-lg px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg",children:[e("header",{className:"bg-white",children:e("div",{className:"max-w-7xl mx-auto py-6 text-center",children:e("h2",{className:"font-semibold text-xl text-gray-800 leading-tight",children:"Welcome"})})}),a("div",{className:"mx-auto text-center space-y-6",children:[e("p",{className:"text-sm text-gray-600",children:"Require a personalised E-Card Quickly?"}),e(r,{href:route("e-card.generation.create"),children:e(s,{className:"mt-6 py-4 px-14",children:"Generate E-Card"})})]})]})}):e(c,{header:e("h2",{className:"font-semibold text-xl text-gray-800 leading-tight",children:"Welcome"}),children:a("div",{className:"mx-auto text-center space-y-6",children:[e("p",{className:"text-sm text-gray-600",children:"Require a personalised E-Card Quickly?"}),e(r,{href:route("e-card.generation.create"),children:e(s,{className:"mt-6 py-4 px-14",children:"Generate E-Card"})})]})})]})}export{p as default};