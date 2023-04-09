import React from "react";
import { useSelector } from "react-redux";
import { selectEmail } from "../../../features/auth/authSlice";
import loginImage from "../../../assets/auth/login-bro.jpg";

const VerifyEmail = () => {
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
      <div className="bg-opacity-black p-8 rounded shadow-md max-w-xl w-full text-gray-300">
        <h2 className="text-xl mb-4">
          メールアドレス受信確認用のメールを送信しました
        </h2>
        <p className="mb-4">
          送信先: <strong className="underline">{email}</strong>
        </p>
        <p className="mb-6">メールをご確認いただき、登録を完了してください。</p>
        <p className="mb-6">受信確認が届かない場合、以下をご確認ください。</p>
        <ul className="list-disc pl-6 mb-4">
          <li>
            迷惑メールフォルダに振り分けられていたり、フィルターや転送によって受信ボックス以外の場所に保管されていないかご確認ください。
          </li>
          <li>
            メールの配信に時間がかかる場合がございます。数分程度待った上で、メールが届いているか再度ご確認ください。
          </li>
          <li>
            登録にご使用のメールアドレス
            <strong className="underline">{email}</strong>
            が正しいかどうか確認してください。正しくない場合は、メールアドレスを再設定してください。
          </li>
        </ul>
      </div>
    </div>
  );
};

export default VerifyEmail;
