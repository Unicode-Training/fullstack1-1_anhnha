export type Product = {
  id?: number;
  name: string;
  price: number;
  description: string;
};

export type ValidateError = {
  name?: string;
  price?: string;
  description?: string;
};
