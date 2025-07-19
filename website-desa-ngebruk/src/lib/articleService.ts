import { parseActionCodeURL } from "firebase/auth";

let storageRefreshCallback: (() => void) | null = null;

export const setStorageRefreshCallback = (callback: () => void) => {
  storageRefreshCallback = callback;
};

const refreshStorageStats = () => {
  if (storageRefreshCallback) {
    storageRefreshCallback();
  }
};

export interface Article {
  id?: string;
  title: string;
  content: string;
  imageUrl?: string;
  imagePath?: string;
  authorId: string;
  authorName: string;
  status: "draft" | "published";
  slug: string;
  excerpt?: string;
}

export interface CreateArticleData {
  title: string;
  content: string;
  image?: File;
  authorId: string;
  authorName: string;
  status: "draft" | "published";
}

export interface UpdateArticleData {
  title?: string;
  content?: string;
  image?: File;
  status?: "draft" | "published";
}

const createSlug = (title: string): string => {
  return title
    .toLowerCase()
    .replace(/[^a-z0-9\s-]/g, "")
    .replace(/\s+/g, "-")
    .replace(/-+/g, "-")
    .trim();
};

const createExcerpt = (content: string, maxLength: number = 150): string => {
  const textContent = content.replace(/<[^>]*>/g, "");
  return textContent.length > maxLength ? textContent.substring(0, maxLength) + "..." : textContent;
};

export const uploadArticleImage = async (file: File, articleId?: string): Promise<{ url: string; path: string }> => {
  const formData = new FormData();
  formData.append('image',file);

  const res = await fetch ("/api/blogs/upload-image",{
    method:"POST",
    body:formData,
  });

  if(!res.ok){
    throw new Error("failed to upload image");
  }

  const data = await res.json();
  return{
    url:data.url,
    path:data.path,
  }
};

export const deleteArticleImage = async (imagePath: string): Promise<void> => {
  const res = await fetch('/api/articles/delete-image',{
    method:"DELETE",
    headers:{"Content-Type":"application/json"},
    body:JSON.stringify({path:imagePath}),
  });

  if(!res.ok){
    throw new Error("Failed to delete image");
  }
};

export const createArticle = async (data: CreateArticleData): Promise<Article> => {
  try {
    const slug = createSlug(data.title);
    const excerpt = createExcerpt(data.content);

    let imageUrl = "";
    let imagePath = "";

    if(data.image){
      const uploadResult = await uploadArticleImage(data.image);
      imageUrl = uploadResult.url;
      imagePath = uploadResult.path;
    }

    const res = await fetch("/api/articles", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        title: data.title,
        content: data.content,
        status: data.status,
        author_id: data.authorId,
        author_name: data.authorName,
        slug,
        excerpt,
        image_url: imageUrl,
        image_path: imagePath,
      }),
    });

    if (!res.ok) {
      throw new Error("Failed to create article");
    }

    const article = await res.json();
    return article;
  } catch (error) {
    console.error("Error creating article:", error);
    throw new Error("Failed to create article");
  }
};

export const getArticles = async (
  page: number = 1,
  perPage: number = 10,
  statusFilter?: "all" | "published" | "draft"
): Promise<{ articles: Article[]; lastVisible: number | null }> => {
  try {
    const params = new URLSearchParams({
      page: page.toString(),
      per_page: perPage.toString(),
    });

    if(statusFilter && statusFilter !== "all"){
      params.append("status", statusFilter);
    }

    const res = await fetch(`api/blogs?${params.toString()}`);

    if (!res.ok){
      throw new Error('Gagal memuat artikel dari server');
    }

    const data = await res.json();

    return{
      articles: data.data,
      lastVisible: data.current_page < data.last_page ? data.current_page + 1 : null,
    };
  } catch (error) {
    console.error("Error getting articles:", error);
    throw new Error('Gagal memuat artikel. Silahkan coba lagi');
  }
};

export const getArticleById = async (id: string): Promise<Article | null> => {
  try {
    const res = await fetch(`/api/blogs?${id}`);
    
    if(!res.ok){
      throw new Error("Failed to fetch articles by ID");
    }
    
    const data = await res.json();
    return data;
  } catch (error) {
    console.error("Error getting article:", error);
    return null;
  }
};

export const getArticleBySlug = async (slug: string): Promise<Article | null> => {
  try {
    const res = await fetch(`api/blogs?${slug}`);
    
    if (!res.ok){
      throw new Error("Failed to fetch article by slug");
    }
    const data = await res.json();
    return data;
  } catch (error) {
    console.error("Error getting article by slug:", error);
    return null;
  }
};

export const updateArticle = async (id: string, data: UpdateArticleData): Promise<Article> => {
  try {
    const updatePayload: any={
      update_at: new Date().toISOString(),
    };

    if (data.title){
      updatePayload.title = data.title;
      updatePayload.slug = createSlug(data.title);
    }

    if(data.content){
      updatePayload.content = data.content;
      updatePayload.excerpt = createExcerpt(data.content);
    }

    if(data.status){
      updatePayload.status = data.status;
    }

    if(data.image){
      const uploadResult = await uploadArticleImage(data.image, id);
      updatePayload.image_url = updatePayload.url;
      updatePayload.image_path = uploadResult.path;
    }

    const res = await fetch(`/api/blogs/${id}`,{
      method: 'PUT',
      headers: { "Content-Type":"application/json"},
      body:JSON.stringify(updatePayload),
    });

    if(!res.ok){
      throw new Error("Gagal memperbarui artikel");
    }

    const updated = await res.json();
    return updated.data;
  } catch (error) {
    console.error("Error updating article:", error);
    throw new Error("Failed to update article");
  }
};

export const deleteArticle = async (id: string): Promise<void> => {
  try {
    const res = await fetch(`/api/blogs/${id}`,{
      method: "DELETE",
    });

    if (!res.ok){
      throw new Error("Gagal menghapus artikel");
    }
  } catch (error) {
    console.error("Error deleting article:", error);
    throw new Error("Failed to delete article");
  }
};

export const searchArticles = async (searchTerm: string): Promise<Article[]> => {
  try {
    const res = await fetch(`/api/blogs/search?q=${encodeURIComponent(searchTerm)}`);
    if (!res.ok) {
      throw new Error("Gagal mencari artikel");
    }
    const data = await res.json();
    return data as Article[];
  } catch (error) {
    console.error("Error searching articles:", error);
    throw new Error("Gagal mencari artikel");
  }
};

export const getPublishedArticles = async (limit?: number): Promise<Article[]> => {
  try {
    const url = limit ? `/api/blogs/published?limit=${limit}` : `/api/blogs/published`;
    const res = await fetch(url);
    if (!res.ok) {
      throw new Error("Gagal mengambil artikel");
    }
    const data = await res.json();
    return data as Article[];
  } catch (error) {
    console.error("Error getting published articles:", error);
    return [];
  }
};

export const getArticlesWithPagination = async (
  page: number = 1,
  pageSize: number = 10,
  statusFilter: "all" | "published" | "draft" = "all"
): Promise<{ articles: Article[]; totalPages: number; totalItems: number }> => {
  try {
    const params = new URLSearchParams({
      page: page.toString(),
      pageSize: pageSize.toString(),
      status: statusFilter,
    });

    const res = await fetch(`/api/blogs?${params.toString()}`);
    if (!res.ok) {
      throw new Error("Failed to fetch articles");
    }

    const result = await res.json();

    return {
      articles: result.data,
      totalPages: result.totalPages,
      totalItems: result.totalItems,
    };
  } catch (error) {
    console.error("Error fetching articles with pagination:", error);
    throw new Error("Gagal memuat artikel");
  }
};

export const getArticleCountByStatus = async (
  statusFilter: "all" | "published" | "draft" = "all"
): Promise<number> => {
  try {
    const params = new URLSearchParams({ status: statusFilter });
    const res = await fetch(`/api/blogs/count?${params.toString()}`);
    if (!res.ok) {
      throw new Error("Failed to count articles");
    }

    const result = await res.json();
    return result.count;
  } catch (error) {
    console.error("Error counting articles:", error);
    return 0;
  }
};


