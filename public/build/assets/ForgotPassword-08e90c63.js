import{_ as d,a as s,j as e,n as u}from"./app-5d2b1de0.js";import{G as c}from"./GuestLayout-7209e42b.js";import{T as p,I as g}from"./TextInput-98be474a.js";import{P as h}from"./PrimaryButton-ecf4ef99.js";import"./background-c9c2257e.js";function P({status:t}){const{data:o,setData:r,post:l,processing:m,errors:i}=d({email:""}),n=a=>{r(a.target.name,a.target.value)};return s(c,{header:e("h2",{className:"font-semibold text-xl text-gray-800 leading-tight",children:"Forgotten Password"}),children:[e(u,{title:"Forgot Password"}),e("div",{className:"mb-4 text-sm text-gray-600",children:"Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one."}),t&&e("div",{className:"mb-4 font-medium text-sm text-green-600",children:t}),s("form",{onSubmit:a=>{a.preventDefault(),l(route("password.email"))},children:[e(p,{id:"email",type:"email",name:"email",value:o.email,className:"mt-1 block w-full",isFocused:!0,onChange:n}),e(g,{message:i.email,className:"mt-2"}),e("div",{className:"flex items-center justify-end mt-4",children:e(h,{className:"ml-4",disabled:m,children:"Email Password Reset Link"})})]})]})}export{P as default};
