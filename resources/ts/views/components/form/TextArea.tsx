import React from "react";

interface PROPS {
  label: string;
  value: string;
  type: string;
  row: number;
  onChange: (e: React.ChangeEvent<HTMLTextAreaElement>) => void;
  errorMessage?: never[];
  placeHolderText: string;
}

const TextArea: React.FC<PROPS> = (props) => {
  return (
    <div className="mb-4 opacity-100">
      <label htmlFor={props.type} className="block text-gray-400 text-left">
        {props.label}
      </label>
      <div className="mt-1">
        <textarea
          id={props.type}
          name={props.type}
          value={props.value}
          rows={props.row}
          onChange={props.onChange}
          className="border border-slate-700 rounded py-2 px-3 w-full bg-black text-white"
          placeholder={props.placeHolderText}
        />
      </div>
      {props.errorMessage && (
        <p className="text-red-500 text-sm font-bold">
          {props.errorMessage ?? [0]}
        </p>
      )}
    </div>
  );
};

export default TextArea;
