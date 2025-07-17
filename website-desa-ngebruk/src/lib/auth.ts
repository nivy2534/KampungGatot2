

export interface UserProfile {
  uid: string;
  email: string;
  name: string;
  role: "admin" | "user";
  createdAt: Date;
  updatedAt?: Date;
}

export interface AuthError {
  code: string;
  message: string;
}

export const signUpWithEmail = async (email: string, password: string, name: string) => {
  try {
    const response = await fetch("http://localhost:8000/api/register",{
      method:"POST",
      headers:{
        "Content-Type": "application/json",
      },
      credentials: "include",
      body: JSON.stringify({email, password, name}),
    });

    if (!response.ok){
      const err = await response.json();
      throw new Error(err.message || "Registrasi gagal");
    }

    const data = await response.json();
    return data;
    /*const userProfile: UserProfile = {
      uid: user.uid,
      email: email,
      name: name,
      role: "admin",
      createdAt: new Date(),
    };*/
  } catch (error: any) {
    return {
      error: {
        code: "auth/registration-failed",
        message: error.message,
      },
    };
  }
};

export const signInWithEmail = async (email: string, password: string) => {
  try {
    const response = await fetch("http://localhost:8000/api/login",{
      method: "POST",
      headers:{
        "Content-Type":"application/json",
      },
      credentials:"include",
      body:JSON.stringify({ email, password }),
    });

    if (!response.ok) {
      const err = await response.json();
      throw new Error(err.message || "Login gagal");
    }

    const data = await response.json();
    return data; 

    /*if (userDoc.exists()) {
      const profile = userDoc.data() as UserProfile;
      return { user, profile };
    } else {
      const userProfile: UserProfile = {
        uid: user.uid,
        email: user.email || email,
        name: user.displayName || "Admin",
        role: "admin",
        createdAt: new Date(),
      };

      await setDoc(doc(db, "users", user.uid), userProfile);
      return { user, profile: userProfile };
    }*/
  } catch (error: any) {
    return {
      error: {
        code: "auth/login-failed",
        message: error.message,
      },
    };
  }
};

export const signOutUser = async () => {
  try {
    await fetch("http://localhost:8000/api/logout", {
      method: "POST",
      credentials: "include",
    });
  } catch (error: any) {
    return {
      error: {
        code: "auth/logout-failed",
        message: error.message,
      },
    };
  }
};

export const resetPassword = async (email: string) => {
  try {
    const response = await fetch('http://localhost:8000/api/forgot-password', {
      method:"POST",
      headers:{
        "Content-Type":"application/json",
      },
      credentials: "include",
      body:JSON.stringify({email}),
    });

    if(!response.ok){
      const err = await response.json();
      throw new Error(err.message || "Gagal mengirim email reset password.")
    }

    const data = await response.json();
    return { message: data.message || "Link reset password telah dikirim ke email."};

  } catch (error: any) {
    return {
      error: {
        code: "auth/reset-password-failed",
        message: error.message,
      },
    };
  }
};

export const getUserProfile = async (uid: string): Promise<UserProfile | null> => {
  try {
    const response = await fetch('http://localhost:8000/api/user',{
      method:"POST",
      credentials:"include",
    });

    if(!response.ok) throw new Error("Gagal mengambil profil");

    const data = await response.json();
    return data.user as UserProfile;
  } catch (error) {
    return null;
  }
};

export const updateUserProfile = async (uid: string, updateData: Partial<UserProfile>): Promise<{ profile: UserProfile } | { error: AuthError }> => {
  try {
    const response = await fetch("http://localhost:8000/api/user",{
      method:"PUT",
      headers:{
        "Content-Type":"application/json",
      },
      credentials:"include",
      body: JSON.stringify(updateData),
    });

    if(!response.ok){
      const err = await response.json();
      return{
        error:{
          code: "profile/updated-failde",
          message: err.message || "Gagal memperbarui profil",
        }
      };
    }

    const data = await response.json();
    return{profile:data.user};
    /*const userDocRef = doc(db, "users", uid);

    await updateDoc(userDocRef, {
      ...updateData,
      updatedAt: new Date(),
    });

    const updatedDoc = await getDoc(userDocRef);
    if (updatedDoc.exists()) {
      const profile = updatedDoc.data() as UserProfile;

      if (updateData.name && auth.currentUser) {
        await updateProfile(auth.currentUser, {
          displayName: updateData.name,
        });
      }

      return { profile };
    } else {
      return {
        error: {
          code: "profile/not-found",
          message: "Profil pengguna tidak ditemukan",
        },
      };
    }*/
  } catch (error: any) {
    return {
      error: {
        code: "profile/update-failed",
        message: error.message,
      },
    };
  }
};

export const checkSession = async ():Promise<UserProfile | null> => {
  try {
    const response = await fetch("http://localhost:8000/api/user", {
      method: "POST",
      credentials: "include",
    });

    if (!response.ok) throw new Error("Tidak ada sesi");

    const data = await response.json();
    return data.user as UserProfile;
  } catch {
    return null;
  }
}

const getAuthErrorMessage = (errorCode: string): string => {
  switch (errorCode) {
    case "auth/user-not-found":
      return "Akun tidak ditemukan. Silakan periksa email Anda.";
    case "auth/wrong-password":
      return "Kata sandi salah. Silakan coba lagi.";
    case "auth/email-already-in-use":
      return "Email sudah terdaftar. Silakan gunakan email lain atau masuk ke akun Anda.";
    case "auth/weak-password":
      return "Kata sandi terlalu lemah. Gunakan minimal 6 karakter.";
    case "auth/invalid-email":
      return "Format email tidak valid.";
    case "auth/user-disabled":
      return "Akun telah dinonaktifkan.";
    case "auth/too-many-requests":
      return "Terlalu banyak percobaan. Silakan coba lagi nanti.";
    case "auth/network-request-failed":
      return "Koneksi internet bermasalah. Silakan periksa koneksi Anda.";
    case "profile/not-found":
      return "Profil pengguna tidak ditemukan.";
    case "auth/missing-email":
      return "Email harus diisi.";
    default:
      return "Terjadi kesalahan. Silakan coba lagi.";
  }
};

