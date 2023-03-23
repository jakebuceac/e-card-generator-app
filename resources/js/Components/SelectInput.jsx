import { forwardRef, useEffect, useRef, useState} from 'react';

export default forwardRef(function SelectInput({ className = '', isFocused = false, options = [], ...props }, ref) {
    const input = ref ? ref : useRef();

    const keys = Object.keys(options);

    const [currentState, setCurrentState] = useState(options[keys[0]])

    const changeState = (newOption) => {
        setCurrentState(newOption)
    }

    useEffect(() => {
        if (isFocused) {
            input.current.focus();
        }
    }, []);

    return (
        <div className="flex flex-col items-start">
            <select
                onChange={(event) => changeState(event.target.value)}
                value={currentState}
                {...props}
                className={
                    'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ' +
                    className
                }
                ref={input}
            >
                <option value="" selected>-</option>
                {keys.map((key) => (
                    <option value={options[key]} key={key}>{key}</option>
                ))}
            </select>
        </div>
    );
});
