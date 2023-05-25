import React from "react";

interface PROPS {
  label: string;
  value: string;
  type: string;
  onChange: (e: React.ChangeEvent<HTMLInputElement>) => void;
  onClick: () => void;
  errorMessage?: never[];
  placeHolderText: string;
}

const AddInputForm: React.FC<PROPS> = (props) => {
  return (
    <div className="my-4 opacity-100">
      <label htmlFor={props.type} className="block text-gray-400 text-left">
        {props.label}
      </label>
      <div className="flex items-center">
        <input
          type={props.type}
          name={props.type}
          id={props.type}
          className="border border-slate-700 rounded py-2 px-3 flex-grow bg-black text-white"
          required
          value={props.value}
          onChange={props.onChange}
          placeholder={props.placeHolderText}
        />
        <button
          type="button"
          onClick={props.onClick}
          className="bg-green-800 hover:bg-green-700 text-white font-bold px-4 py-2 rounded-r flex items-center"
        >
          <span className="mx-1">追加</span>
        </button>
        {props.errorMessage && (
          <p className="text-red-500 text-sm font-bold">
            {props.errorMessage ?? [0]}
          </p>
        )}
      </div>
    </div>
  );
};

export default AddInputForm;
