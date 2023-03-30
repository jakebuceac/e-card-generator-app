import{_ as p,r as f,a,j as e,n as g,d as h}from"./app-5b810beb.js";import{G as w}from"./GuestLayout-309fcb23.js";import{T as m,I as i}from"./TextInput-30b20803.js";import{I as n}from"./InputLabel-c3fc1590.js";import{P as N}from"./PrimaryButton-e8c31e98.js";import"./background-8b914473.js";function F(){const{data:r,setData:l,post:d,processing:c,errors:t,reset:u}=p({name:"",email:"",password:"",password_confirmation:""});f.useEffect(()=>()=>{u("password","password_confirmation")},[]);const o=s=>{l(s.target.name,s.target.type==="checkbox"?s.target.checked:s.target.value)};return a(w,{header:e("h2",{className:"font-semibold text-xl text-gray-800 leading-tight",children:"Register"}),children:[e(g,{title:"Register"}),a("form",{onSubmit:s=>{s.preventDefault(),d(route("register"))},children:[a("div",{children:[e(n,{htmlFor:"name",value:"Name*"}),e(m,{id:"name",name:"name",value:r.name,className:"mt-1 block w-full",autoComplete:"name",isFocused:!0,onChange:o,required:!0}),e(i,{message:t.name,className:"mt-2"})]}),a("div",{className:"mt-4",children:[e(n,{htmlFor:"email",value:"Email*"}),e(m,{id:"email",type:"email",name:"email",value:r.email,className:"mt-1 block w-full",autoComplete:"username",onChange:o,required:!0}),e(i,{message:t.email,className:"mt-2"})]}),a("div",{className:"mt-4",children:[e(n,{htmlFor:"password",value:"Password*"}),e(m,{id:"password",type:"password",name:"password",value:r.password,className:"mt-1 block w-full",autoComplete:"new-password",onChange:o,required:!0}),e(i,{message:t.password,className:"mt-2"})]}),a("div",{className:"mt-4",children:[e(n,{htmlFor:"password_confirmation",value:"Confirm Password*"}),e(m,{id:"password_confirmation",type:"password",name:"password_confirmation",value:r.password_confirmation,className:"mt-1 block w-full",autoComplete:"new-password",onChange:o,required:!0}),e(i,{message:t.password_confirmation,className:"mt-2"})]}),a("div",{className:"flex items-center justify-end mt-4",children:[e(h,{href:route("login"),className:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500",children:"Already registered?"}),e(N,{className:"ml-4",disabled:c,children:"Register"})]})]})]})}export{F as default};
