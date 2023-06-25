export interface INITIAL_STATE {
  notification: {
    id: number;
    title: string;
    body: string;
    publishedAt: string;
    isPublished: number;
    isSent: number;
    createdAt: string;
    updatedAt: string;
  }[];
  total: number;
  lastPage: number;
  currentPage: number;
  links: {
    url: string | null;
    label: string;
    active: boolean;
  }[];
  message: string;
  errors: [];
}

export interface PAGEDATA {
  perPage: number;
  currentPage: number;
}
