import React from "react";

interface PROPS {
  label: string;
  value: number;
  type: string;
  optional?: ReadonlyArray<{
    label: string;
    value: number;
  }>;
  onChange: (e: React.ChangeEvent<HTMLSelectElement>) => void;
  errorMessage: never[];
  placeHolderText: string;
}

const SelectBox: React.FC<PROPS> = (props) => {
  const placeHolderColor = props.value ? "text-white" : "text-gray-400";

  return (
    <div className="mb-4 opacity-100">
      <label htmlFor={props.type} className="block text-gray-400 text-left">
        {props.label}
      </label>
      <select
        name={props.label}
        id={props.label}
        className={`border border-slate-700 rounded py-2 px-3 w-full bg-black ${placeHolderColor}`}
        value={props.value}
        onChange={props.onChange}
        required
      >
        <option value="" selected hidden className="text-sm">
          {props.placeHolderText}
        </option>
        {props.optional?.map((option) => (
          <option key={option.label} value={option.value}>
            {option.label}
          </option>
        ))}
      </select>
      {props.errorMessage && (
        <p className="text-red-500 text-sm font-bold">
          {props.errorMessage ?? [0]}
        </p>
      )}
    </div>
  );
};

export default SelectBox;
