import React from "react";

interface PROPS {
  label: string;
  value: string;
  type: string;
  onChange: (e: React.ChangeEvent<HTMLInputElement>) => void;
  errorMessage: never[];
  placeHolderText: string;
}

const InputForm: React.FC<PROPS> = (props) => {
  return (
    <div className="mb-4 opacity-100">
      <label htmlFor={props.type} className="block text-gray-400 text-left">
        {props.label}
      </label>
      <input
        type={props.type}
        name={props.type}
        id={props.type}
        className="border border-slate-700 rounded py-2 px-3 w-full bg-black text-white"
        required
        value={props.value}
        onChange={props.onChange}
        placeholder={props.placeHolderText}
      />
      {props.errorMessage && (
        <p className="text-red-500 text-sm font-bold">
          {props.errorMessage ?? [0]}
        </p>
      )}
    </div>
  );
};

export default InputForm;
