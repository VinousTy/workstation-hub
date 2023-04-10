import React from "react";
import { useSelector } from "react-redux";
import { selectEmail } from "../../../features/auth/authSlice";
import loginImage from "../../../assets/auth/login-bro.jpg";

const ForgotPasswordCompalate = () => {
  const email = useSelector(selectEmail);

  return (
    <div
      className="min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat bg-gradient-to-br from-blue-500 to-indigo-500 before:bg-opacity-black before:bg-inherit before:backdrop-filter before:backdrop-blur-lg before:absolute before:-top-5 before:-left-5 before:-right-5 before:-bottom-5 before:z-[-1]"
      style={{
        backgroundImage: ` linear-gradient(
    rgba(32, 32, 32, 0.6),
    rgba(32, 32, 32, 0.6)
  ), url(${loginImage})`,
      }}
    >
      <div className="bg-opacity-black p-8 rounded shadow-md max-w-md w-full text-gray-300">
        <h2 className="text-xl font-medium mb-4">
          パスワード再設定リンクを送信しました
        </h2>
        <p className="mb-6">
          パスワード再設定メールを{" "}
          <strong className="underline">{email}</strong>
          宛に送信しました。
        </p>
        <p>お送りしたメールの内容に従ってパスワードを再設定してください。</p>
      </div>
    </div>
  );
};

export default ForgotPasswordCompalate;
