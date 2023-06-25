import React, { useEffect, useState } from "react";
import { AppDispatch } from "../../../../features/store";
import { useDispatch } from "react-redux";
import {
  getNotification,
  selectNotification,
} from "../../../../features/admin/notification/notificationSlice";
import { useSelector } from "react-redux";

const IndexPage = () => {
  const dispatch: AppDispatch = useDispatch();
  const notifications = useSelector(selectNotification);
  const [currentPage, setCurrentPage] = useState(1);
  const [perPage, setPerPage] = useState(10);

  useEffect(() => {
    dispatch(
      getNotification({
        perPage: perPage,
        currentPage: currentPage,
      })
    );
  }, [currentPage, perPage]);

  const handlePageChange = (page: number) => {
    setCurrentPage(page);
  };

  const handlePerPageChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
    setPerPage(Number(e.target.value));
  };

  const renderPageNumbers = () => {
    const lastPage = notifications.lastPage;
    const pageNumbers = [];
    // 最大表示ページ数
    // NOTE:5をセットした場合 1 2 3 4 5 ... 50
    const maxPageNumbersToShow = 5;
    const sidePageNumbersCount = 2;
    let startPageNumber = 1;
    let endPageNumber = lastPage;

    // 最終ページが最大表示ページ数より多い場合
    if (lastPage > maxPageNumbersToShow) {
      // 現在のページがサイドに表示するページ数より少ない場合、最終ページ数を最大表示ページ数にする
      if (currentPage <= sidePageNumbersCount) {
        endPageNumber = maxPageNumbersToShow;
      } // 現在のページが最後のページの近くにある場合
      else if (currentPage > lastPage - sidePageNumbersCount) {
        startPageNumber = lastPage - maxPageNumbersToShow + 1;
      }
      // 現在のページが中間の範囲にある場合
      else {
        startPageNumber = currentPage - sidePageNumbersCount;
        endPageNumber = currentPage + sidePageNumbersCount;
      }
    }

    for (let page = startPageNumber; page <= endPageNumber; page++) {
      pageNumbers.push(
        <button
          key={page}
          onClick={() => handlePageChange(page)}
          className={`${
            page === currentPage
              ? "bg-blue-800 text-white"
              : "bg-gray-900 text-gray-300"
          } font-bold py-2 px-3 rounded-lg focus:outline-none focus:shadow-outline`}
        >
          {page}
        </button>
      );
    }

    return pageNumbers;
  };

  return (
    <div className="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
      <div className="max-w-4xl mx-auto">
        <h1 className="text-white text-3xl font-bold mb-4">お知らせ一覧</h1>
        <div className="flex justify-between items-center mb-8">
          <div>
            <label className="text-white">表示件数:</label>
            <select
              value={perPage}
              onChange={handlePerPageChange}
              className="bg-gray-900 text-white font-bold py-2 px-4 ml-2 rounded focus:outline-none focus:shadow-outline"
            >
              <option value={10}>10件</option>
              <option value={50}>50件</option>
              <option value={100}>100件</option>
            </select>
          </div>
          <button className="bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition">
            お知らせ追加
          </button>
        </div>
        <div className="bg-gray-800 shadow overflow-hidden sm:rounded-lg">
          <table className="min-w-full divide-y divide-gray-700">
            <thead className="bg-gray-800">
              <tr>
                <th className="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                  タイトル
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                  公開状態
                </th>
                <th className="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                  公開日時
                </th>
              </tr>
            </thead>
            <tbody className="bg-gray-900 divide-y divide-gray-700">
              {notifications?.notification.map((notification) => (
                <tr key={notification.id}>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <div className="text-sm text-white">
                      {notification.title}
                    </div>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    <span
                      className={`px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${
                        notification.isPublished
                          ? "bg-green-600 text-green-100"
                          : "bg-red-600 text-red-100"
                      }`}
                    >
                      {notification.isPublished ? "公開中" : "非公開"}
                    </span>
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-sm text-white">
                    {notification.publishedAt}
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
        <div className="flex justify-center mt-8">
          <nav className="flex items-center" role="navigation">
            {currentPage > 1 && (
              <button
                onClick={() => handlePageChange(currentPage - 1)}
                className="bg-gray-900 text-gray-300 font-bold py-2 px-3 rounded-lg focus:outline-none focus:shadow-outline"
              >
                {"<"}
              </button>
            )}
            {currentPage > 3 && (
              <button
                onClick={() => handlePageChange(1)}
                className="bg-gray-900 text-gray-300 font-bold py-2 px-3 rounded-lg focus:outline-none focus:shadow-outline"
              >
                {"1"}
              </button>
            )}
            {currentPage > 4 && (
              <span className="bg-gray-900 text-gray-300 font-bold py-2 px-3 rounded-lg focus:outline-none focus:shadow-outline">
                ...
              </span>
            )}
            {renderPageNumbers()}
            {currentPage < notifications.lastPage - 3 && (
              <span className="bg-gray-900 text-gray-300 font-bold py-2 px-3 rounded-lg focus:outline-none focus:shadow-outline">
                ...
              </span>
            )}
            {currentPage < notifications.lastPage - 2 && (
              <button
                onClick={() => handlePageChange(notifications.lastPage)}
                className="bg-gray-900 text-gray-300 font-bold py-2 px-3 rounded-lg focus:outline-none focus:shadow-outline"
              >
                {notifications.lastPage}
              </button>
            )}
            {currentPage < notifications.lastPage && (
              <button
                onClick={() => handlePageChange(currentPage + 1)}
                className="bg-gray-900 text-gray-300 font-bold py-2 px-3 rounded-lg focus:outline-none focus:shadow-outline"
              >
                {">"}
              </button>
            )}
          </nav>
        </div>
      </div>
    </div>
  );
};

export default IndexPage;
