import React from "react";
import { inputPlaceholder } from "../../../utils/lang";

interface PROPS {
  label: string;
  value: string;
  type: string;
  onChange: (e: React.ChangeEvent<HTMLInputElement>) => void;
  errorMessage: never[];
}

const InputForm: React.FC<PROPS> = (props) => {
  const placeHolderText =
    props.type === "email" ? inputPlaceholder.email : inputPlaceholder.password;

  return (
    <div className="mb-4 opacity-100">
      <label
        htmlFor={props.type}
        className="block text-gray-400 font-bold mb-2 text-left"
      >
        {props.label}
      </label>
      <input
        type={props.type}
        name={props.type}
        id={props.type}
        className="border rounded py-2 px-3 w-full"
        required
        value={props.value}
        onChange={props.onChange}
        placeholder={placeHolderText}
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
