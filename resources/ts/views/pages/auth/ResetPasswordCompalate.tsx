import React from "react";
import loginImage from "../../../assets/auth/login-bro.jpg";
import TransitionButton from "../../components/button/TransitionButton";

const ResetPasswordComplate = () => {
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
          パスワードの再設定が完了しました
        </h2>
        <p className="mb-6">正常にパスワードの再設定が完了しました。</p>
        <p className="mb-6">
          下記ボタンから新規パスワードを利用してログインを行なってください。
        </p>
        <TransitionButton label="ログイン画面へ" transition="/login" />
      </div>
    </div>
  );
};

export default ResetPasswordComplate;
