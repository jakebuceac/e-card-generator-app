import {ClipLoader} from "react-spinners";
export default function Spinner({ className = '', disabled, children, ...props }) {
    return (
        <div {...props} className="m-auto justify-center">
            <ClipLoader  color="#6366F1" size={120}/>
        </div>
    );
}
