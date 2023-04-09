import React from 'react'

const test = () => {
  return (
    <div className="w-10/12 md:w-11/12 md:flex bg-white shadow-2xl my-24 mx-auto rounded-3xl lg:w-10/12">
        <div className="mx-auto md:w-7/12 lg:w-6/12 py-8">
          <div className="text-center text-white h-auto rounded">
            <h2
              className="mb-10 text-black text-xl font-bold lg:pt-14"
              data-testid="title"
            >
              ログイン
            </h2>
            <div className="mb-4">
              <div className="sm:ml-16 mt-8 text-left mb-1 pl-1 ml-9 text-gray-700 md:ml-14 md:mt-0">
                <label htmlFor="email" data-testid="label-email">
                  メールアドレス
                </label>
              </div>
              <input
                className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 w-9/12 py-2 px-3 mb-5"
                id="email"
                data-testid="input-email"
                type="text"
                placeholder="例) info@example.com"
              />
            </div>
            <div className="mb-6">
              <div className="sm:ml-16 text-left text-gray-700 ml-9 md:ml-14 mb-1 pl-1">
                <label htmlFor="password" data-testid="label-password">
                  パスワード
                </label>
              </div>
              <input
                className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 w-9/12 py-2 px-3 mb-5"
                id="password"
                data-testid="input-password"
                type="password"
                placeholder="8文字以上で入力してください"
              />
            </div>
            <SubmitButton label="ログイン" />
            <div className="mt-4 text-center flex items-center">
              <hr className="flex-1 border-t-2 border-gray-300" />
              <span className="text-gray-500 font-bold mx-2">または</span>
              <hr className="flex-1 border-t-2 border-gray-300" />
            </div>
            <div className="flex flex-col space-y-2 mt-4">
              <button
                type="button"
                className="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
              >
                <i className="fab fa-google mr-2"></i>
                Googleでログイン
              </button>
            </div>
            <div className="mb-6 pb-6">
              <p
                className="text-blue-400 underline ... cursor-pointer hover:text-red-500 transition-all"
                onClick={() => history.push('/reset')}
              >
                パスワードを忘れた方はこちら
              </p>
            </div>
          </div>
        </div>
          <div className="w-8/12 bg-orange pt-28 rounded-r-3xl text-center">
            <img
              className="md:w-11/12 lg:w-10/12 mx-auto"
              src={signin}
              alt="ログイン画面へようこそ"
              data-testid="img"
            />
            <a
              className="text-story-set text-xs"
              href="https://storyset.com/user"
            >
              User illustrations by Storyset
            </a>
          </div>
      </div>
  )
}

export default test