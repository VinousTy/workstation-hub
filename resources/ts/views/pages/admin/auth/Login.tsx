import React, { useCallback, useState } from "react";
import SubmitButton from "../../../components/button/SubmitButton";
import { UserType } from "../../../../utils/enums/user/UserType";
import { AppDispatch } from "../../../../features/store";
import { useDispatch } from "react-redux";
import { adminLogin } from "../../../../features/admin/auth/authSlice";
import { useNavigate } from "react-router-dom";
import AdminInputForm from "../../../components/form/AdminInputForm";
import { AdminInputPlaceholder } from "../../../../utils/lang";

const Login = () => {
  const dispatch: AppDispatch = useDispatch();
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [errors, setErrors] = useState({
    name: [],
    email: [],
    password: [],
  });
  const navigate = useNavigate();

  const changedEmail = useCallback(
    (e: React.ChangeEvent<HTMLInputElement>) => {
      setEmail(e.target.value);
    },
    [setEmail]
  );

  const changedPassword = useCallback(
    (e: React.ChangeEvent<HTMLInputElement>) => {
      setPassword(e.target.value);
    },
    [setPassword]
  );

  const handleSubmit = async (e: React.SyntheticEvent) => {
    e.preventDefault();

    await dispatch(
      adminLogin({
        email: email,
        password: password,
      })
    )
      .unwrap()
      .then((res) => {
        navigate("/admin/notification");
      })
      .catch((error) => {
        setErrors(error);
      });
  };

  return (
    <div className="min-h-screen flex items-center justify-center">
      <div className="bg-opacity-black p-8 rounded shadow-md max-w-md w-full">
        <h1 className="text-2xl text-gray-300 font-bold mb-6 text-center">
          管理者ログイン
        </h1>
        <form method="post" onSubmit={handleSubmit}>
          <AdminInputForm
            label="メールアドレス"
            value={email}
            type="email"
            onChange={changedEmail}
            errorMessage={errors.email}
            placeHolderText={AdminInputPlaceholder.email}
          />
          <AdminInputForm
            label="パスワード"
            value={password}
            type="password"
            onChange={changedPassword}
            errorMessage={errors.password}
            placeHolderText={AdminInputPlaceholder.password}
          />
          {errors.name && (
            <p className="text-red-500 text-sm font-bold mb-2">
              {errors?.name[0]}
            </p>
          )}
          <div className="flex items-center mb-4">
            <input
              type="checkbox"
              name="remember"
              id="remember"
              className="mr-2"
            />
            <label htmlFor="remember" className="text-gray-400 font-bold">
              ログイン情報を保存する
            </label>
          </div>
          <SubmitButton userType={UserType.admin} label="ログイン" />
        </form>
      </div>
    </div>
  );
};

export default Login;
