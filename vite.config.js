import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";

export default defineConfig({
  plugins: [
    laravel({
      input: ["resources/css/app.css", "resources/ts/index.tsx"],
      refresh: true,
    }),
    react(),
  ],
  server: {
    host: true,
    hmr: {
      host: "localhost",
    },
  },
  css: {
    modules: {
      localsConvention: "camelCaseOnly",
    },
    postcss: {
      plugins: [
        require("tailwindcss"),
        require("autoprefixer"),
        // 以下を追加
        require("postcss-modules-values-replace")({
          replacements: {
            "slick-theme.css":
              "/node_modules/slick-carousel/slick/slick-theme.css",
            "slick.css": "/node_modules/slick-carousel/slick/slick.css",
          },
        }),
      ],
    },
  },
});
