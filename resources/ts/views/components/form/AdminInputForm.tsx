import React from "react";

interface PROPS {
  label: string;
  value: string;
  type: string;
  onChange: (e: React.ChangeEvent<HTMLInputElement>) => void;
  errorMessage: never[];
  placeHolderText: string;
}

const AdminInputForm: React.FC<PROPS> = (props) => {
  return (
    <div className="mb-4">
      <label htmlFor="email" className="text-gray-400 font-bold">
        {props.label}
      </label>
      <input
        className="w-full px-3 py-2 bg-transparent border-b-2 border-gray-400 focus:border-blue-500 outline-none text-gray-200"
        required
        id={props.type}
        type={props.type}
        name={props.type}
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

export default AdminInputForm;
