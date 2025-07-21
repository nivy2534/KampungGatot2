import axios from "axios";
import api from "./api";

let storageRefreshCallback: (() => void) | null = null;

export const setStorageRefreshCallback = (callback: () => void) => {
  storageRefreshCallback = callback;
};

const refreshStorageStats = () => {
  if (storageRefreshCallback) {
    storageRefreshCallback();
  }
};

export interface GalleryImage {
  id: number;
  photoName: string;
  photoDescription: string;
  photoDate: string;
  imageUrl: string;
  imagePath: string;
  eventId: number | null;
  productionId: number | null;
  blogId: number | null;

  // Tambahkan properti tambahan jika dibutuhkan oleh fungsi tertentu
  title?: string;
  description?: string;
  category?: string;
  isActive?: boolean;
  order?: number;
  createdAt?: Date;
  updatedAt?: Date;
  createdBy?: string;
  updatedBy?: string;
}

interface LaravelPaginationMeta {
  current_page: number;
  last_page: number;
  total: number;
}

export interface CreateGalleryImageData {
  id: number;
  photoName: string;
  photoDescription: string;
  photoDate: string;
  imageUrl: string;
  imagePath: string;
  eventId: number | null;
  productionId: number | null;
  blogId: number | null;
  image:File;

  // Tambahkan properti tambahan jika dibutuhkan oleh fungsi tertentu
  title?: string;
  description?: string;
  category?: string;
  isActive?: boolean;
  order?: number;
  createdAt?: Date;
  updatedAt?: Date;
  createdBy?: string;
  updatedBy?: string;
}

export interface UpdateGalleryImageData {
  photoName?: string;
  photoDescription?: string;
  photoDate?: string;
  eventId?: number | null;
  productionId?: number | null;
  blogId?: number | null;
  image?: File;
}

interface GalleryImageAPIResponse {
  data: {
    id: number;
    photo_name: string;
    photo_description: string;
    photo_date: string;
    image_url: string;
    image_path: string;
    event_id: number | null;
    production_id: number | null;
    blog_id: number | null;
  }[];
  meta: LaravelPaginationMeta;
}

export const uploadGalleryImage = async (file: File, token: string): Promise<{ url: string; path: string }> => {
  const formData = new FormData();
  formData.append("image", file);
  formData.append("title", file.name); // bisa disesuaikan
  formData.append("description", ""); // opsional

  const res = await fetch(`api/photos`, {
    method: "POST",
    headers: {
      Authorization: `Bearer ${token}`,
    },
    body: formData,
  });

  if (!res.ok) {
    const errorData = await res.json();
    console.error("Upload error:", errorData);
    throw new Error(errorData.message || "Failed to upload image");
  }

  const data = await res.json();
  return {
    url: data.image_url,
    path: data.image_path,
  };
};



export const deleteGalleryImage = async (photoId: string, token: string): Promise<void> => {
  const res = await fetch(`api/photos/${photoId}`, {
    method: "DELETE",
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });

  if (!res.ok) {
    console.error("Failed to delete image");
    throw new Error("Failed to delete image");
  }
};


export const createGalleryImage = async (
  data: CreateGalleryImageData,
  token: string
): Promise<GalleryImage> => {
  const formData = new FormData();
  formData.append("image", data.image); // pastikan 'image' adalah File atau Blob
  formData.append("title", data.title || "");
  formData.append("description", data.description || "");
  formData.append("category", data.category || "umum");
  formData.append("is_active", data.isActive ? "1" : "0");
  formData.append("order", data.order?.toString() || "0");

  const res = await fetch(`api/photos`, {
    method: "POST",
    headers: {
      Authorization: `Bearer ${token}`,
    },
    body: formData,
  });

  if (!res.ok) {
    const errorData = await res.json();
    console.error("Error creating image:", errorData);
    throw new Error("Gagal membuat image galeri");
  }

  const result = await res.json();

  return {
    id: result.id,
    photoName: result.photo_name,
    photoDescription: result.photo_description,
    photoDate: result.photo_date,
    imageUrl: result.image_url,
    imagePath: result.image_path,
    eventId: result.event_id,
    productionId: result.production_id,
    blogId: result.blog_id,
    isActive: result.is_active,
    order: result.order,
  };
};



export const getGalleryImages = async (
  page: number = 1,
  pageSize: number = 10,
  statusFilter?: "all" | "active" | "inactive"
): Promise<{ images: GalleryImage[]; nextPage: number | null }> => {
  try {
    const params: any = {
      page,
      limit: pageSize,
    };

    if (statusFilter && statusFilter !== "all") {
      params.status = statusFilter;
    }

    const response = await axios.get<GalleryImageAPIResponse>("/api/photos", { params });

    const { data, meta } = response.data;

    const images: GalleryImage[] = data.map((item) => ({
      id: item.id,
      photoName: item.photo_name,
      photoDescription: item.photo_description,
      photoDate: item.photo_date,
      imageUrl: item.image_url,
      imagePath: item.image_path,
      eventId: item.event_id,
      productionId: item.production_id,
      blogId: item.blog_id,
    }));

    const hasMore = meta.current_page < meta.last_page;

    return {
      images,
      nextPage: hasMore ? page + 1 : null,
    };
  } catch (error) {
    console.error("Error fetching gallery images:", error);
    throw new Error("Gagal memuat data galeri.");
  }
};



export const getGalleryImageById = async (id: string): Promise<GalleryImage | null> => {
  try {
    const response = await axios.get(`/api/photos/${id}`);

    if (response.status !== 200 || !response.data) {
      return null;
    }

    const data = response.data as {
      id: number;
      photo_name: string;
      photo_description: string;
      photo_date: string;
      image_url: string;
      image_path: string;
      event_id: number | null;
      production_id: number | null;
      blog_id: number | null;
    };


    return {
      id: data.id,
      photoName: data.photo_name,
      photoDescription: data.photo_description,
      photoDate: data.photo_date,
      imageUrl: data.image_url,
      imagePath: data.image_path,
      eventId: data.event_id,
      productionId: data.production_id,
      blogId: data.blog_id,
    };
  } catch (error) {
    console.error("Error fetching gallery image:", error);
    throw new Error("Failed to fetch gallery image");
  }
};



export const updateGalleryImage = async (
  id: string,
  data: UpdateGalleryImageData
): Promise<GalleryImage> => {
  try {
    const formData = new FormData();

    if (data.photoName !== undefined) formData.append("photo_name", data.photoName);
    if (data.photoDescription !== undefined) formData.append("photo_description", data.photoDescription);
    if (data.photoDate !== undefined) formData.append("photo_date", data.photoDate);
    if (data.eventId !== undefined) formData.append("event_id", data.eventId?.toString() ?? "");
    if (data.productionId !== undefined) formData.append("production_id", data.productionId?.toString() ?? "");
    if (data.blogId !== undefined) formData.append("blog_id", data.blogId?.toString() ?? "");
    if (data.image !== undefined) formData.append("image", data.image);

    const response = await axios.post(`/api/photos/${id}`, formData, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    });

    const updated = response.data as {
      id: number;
      photo_name: string;
      photo_description: string;
      photo_date: string;
      image_url: string;
      image_path: string;
      event_id: number | null;
      production_id: number | null;
      blog_id: number | null;
    };

    return {
      id: updated.id,
      photoName: updated.photo_name,
      photoDescription: updated.photo_description,
      photoDate: updated.photo_date,
      imageUrl: updated.image_url,
      imagePath: updated.image_path,
      eventId: updated.event_id,
      productionId: updated.production_id,
      blogId: updated.blog_id,
    };
  } catch (error) {
    console.error("Error updating gallery image:", error);
    throw new Error("Failed to update gallery image");
  }
};

export const deleteGalleryImageById = async (id: string): Promise<void> => {
  try {
    await axios.delete(`/api/photos/${id}`);
  } catch (error) {
    console.error("Error deleting gallery image:", error);
    throw new Error("Failed to delete gallery image");
  }
};

export const getActiveGalleryImages = async (
  limitCount?: number
): Promise<GalleryImage[]> => {
  try {
    const response = await axios.get<GalleryImageAPIResponse>("/api/photos", {
      params: {
        status: "active",
        limit: limitCount ?? 10,
      },
    });

    const dataArray = response.data.data; // gunakan .data jika responsenya memiliki field data

    const images: GalleryImage[] = dataArray.map((data: any) => ({
      id: data.id,
      photoName: data.photo_name,
      photoDescription: data.photo_description,
      photoDate: data.photo_date,
      imageUrl: data.image_url || "",
      imagePath: data.image_path || "",
      category: data.category || "umum",
      isActive: data.is_active ?? true,
      order: data.order || 0,
      createdAt: new Date(data.created_at),
      updatedAt: new Date(data.updated_at),
      createdBy: data.created_by || "",
      updatedBy: data.updated_by || "",
      eventId: data.event_id ?? null,
      productionId: data.production_id ?? null,
      blogId: data.blog_id ?? null,
    }));

    // Urutkan berdasarkan updatedAt terbaru
    images.sort((a, b) => {
      const aTime = a.updatedAt?.getTime() ?? 0;
      const bTime = b.updatedAt?.getTime() ?? 0;
      return bTime - aTime;
    });

    return images;
  } catch (error) {
    console.error("Error fetching active gallery images:", error);
    return [];
  }
};


export const searchGalleryImages = async (searchTerm: string): Promise<GalleryImage[]> => {
  try {
    const response = await axios.get<{ data: GalleryImage[] }>("/api/photos", {
      params: {
        search: searchTerm,
      },
    });

    const images: GalleryImage[] = response.data.data.map((image: any) => ({
      id: image.id,
      photoName: image.photo_name ?? "Untitled",
      photoDescription: image.photo_description ?? "",
      photoDate: image.photo_date ?? "",
      imageUrl: image.image_url ?? "",
      imagePath: image.image_path ?? "",
      eventId: image.event_id ?? null,
      productionId: image.production_id ?? null,
      blogId: image.blog_id ?? null,
    }));

    return images;
  } catch (error) {
    console.error("Error searching gallery images:", error);
    throw new Error("Gagal mencari gambar galeri");
  }
};

export const getGalleryImagesWithPagination = async (
  page: number = 1,
  pageSize: number = 10,
  statusFilter: "all" | "active" | "inactive" = "all"
): Promise<{ images: GalleryImage[]; totalPages: number; totalItems: number }> => {
  try {
    const status = statusFilter !== "all" ? statusFilter : "";

    const response = await api.get<GalleryImageAPIResponse>("/api/photos", {
      params: {
        page,
        limit: pageSize,
        status, // opsional, jika kamu pakai filter aktif/inaktif di backend
      },
    });

    const rawImages = response.data.data;
    const meta = response.data.meta;

    const images: GalleryImage[] = rawImages.map((image: any) => ({
      id: image.id,
      photoName: image.photo_name ?? "Untitled",
      photoDescription: image.photo_description ?? "",
      photoDate: image.photo_date ?? "",
      imageUrl: image.image_url ?? "",
      imagePath: image.image_path ?? "",
      eventId: image.event_id ?? null,
      productionId: image.production_id ?? null,
      blogId: image.blog_id ?? null,
    }));

    return {
      images,
      totalPages: meta?.last_page ?? 1,
      totalItems: meta?.total ?? images.length,
    };
  } catch (error) {
    console.error("Error fetching gallery images with pagination:", error);
    throw new Error("Gagal memuat gambar galeri");
  }
};


export const getGalleryImageCountByStatus = async (
  statusFilter: "all" | "active" | "inactive" = "all"
): Promise<number> => {
  try {
    const params = statusFilter !== "all" ? { status: statusFilter } : {};

    // 👇 beri tahu TypeScript bentuk response-nya
    const response = await api.get<{ count: number }>("/api/photos/count", { params });

    return response.data.count ?? 0;
  } catch (error) {
    console.error("Error counting gallery images:", error);
    return 0;
  }
};





