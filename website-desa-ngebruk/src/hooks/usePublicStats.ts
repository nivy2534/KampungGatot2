"use client";

import { useState, useEffect } from "react";

export const usePublicStats = () => {
  const [totalArticles, setTotalArticles] = useState(0);
  const [totalAnnouncements, setTotalAnnouncements] = useState(0);
  const [activeAnnouncements, setActiveAnnouncements] = useState(0);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchPublicStats = async () => {
      try {
        setLoading(true);

        const blogRes = await fetch('http://127.0.0.1:8000/api/blogs');
        const blog = await blogRes.json();
        setTotalArticles(blog.length||0);

        const announceRes = await fetch('http://127.0.0.1:8000/api/events');
        const event = await announceRes.json();
        setTotalAnnouncements(event.length||0);

        const now = new Date();
        const today = now.toISOString().split("T")[0];
        const activeCount = event.filter(
          (event: any) =>
            event.start_date<= today && event.end_date >= today
        ).length;
        setActiveAnnouncements(activeCount);

        setError(null);
        /*const articlesQuery = query(collection(db, "articles"), where("status", "==", "published"));
        const articlesSnapshot = await getCountFromServer(articlesQuery);
        const articlesCount = articlesSnapshot.data().count;
        setTotalArticles(articlesCount);

        const announcementsQuery = query(collection(db, "announcements"));
        const announcementsSnapshot = await getCountFromServer(announcementsQuery);
        const announcementsCount = announcementsSnapshot.data().count;
        setTotalAnnouncements(announcementsCount);

        const now = new Date();
        const activeQuery = query(collection(db, "announcements"), where("startDate", "<=", now.toISOString().split("T")[0]), where("endDate", ">=", now.toISOString().split("T")[0]));
        const activeSnapshot = await getCountFromServer(activeQuery);
        const activeCount = activeSnapshot.data().count;
        setActiveAnnouncements(activeCount);

        setError(null);*/
      } catch (err) {
        console.error("Error fetching public stats:", err);
        setError("Gagal memuat statistik");
        setTotalArticles(156);
        setTotalAnnouncements(42);
        setActiveAnnouncements(8);
      } finally {
        setLoading(false);
      }
    };

    fetchPublicStats();
  }, []);

  return {
    totalArticles,
    totalAnnouncements,
    activeAnnouncements,
    loading,
    error,
  };
};

