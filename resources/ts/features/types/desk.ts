export interface DESK_INITIALSTATE {
  data: {
    desk: {
      id: string;
      description: string | null;
    };
    user: {
      id: string;
      name: string;
    };
    profile: {
      id: string;
      file_path: string | undefined;
    };
    categories: [
      {
        id: string;
        name: string;
      }
    ];
    images: [];
  }[];
  errors: [] | unknown;
}

export interface POST_DESK_DATA {
  category: string[];
  description: string;
}
