import { initializeApp } from "firebase/app";
import { getFirestore, doc, setDoc, collection } from "firebase/firestore";
import { profileData, educationData, experienceData, projectData, skillData, certificationData, feedbackData } from './src/data.js';

const firebaseConfig = {
  apiKey: "AIzaSyCvOz3H_P8gJeqTJTrpW9H_GrCqVtt4s1A",
  authDomain: "ganeshmogal-07.firebaseapp.com",
  projectId: "ganeshmogal-07",
  storageBucket: "ganeshmogal-07.firebasestorage.app",
  messagingSenderId: "50210810291",
  appId: "1:50210810291:web:929833322496d6903383c6"
};

const app = initializeApp(firebaseConfig);
const db = getFirestore(app);

async function seedData() {
  console.log("Seeding profile...");
  await setDoc(doc(db, 'portfolio', 'profile'), profileData);

  console.log("Seeding education...");
  for (const item of educationData) {
    await setDoc(doc(collection(db, 'education')), item);
  }

  console.log("Seeding experience...");
  for (const item of experienceData) {
    await setDoc(doc(collection(db, 'experience')), item);
  }

  console.log("Seeding projects...");
  for (const item of projectData) {
    await setDoc(doc(collection(db, 'projects')), item);
  }

  console.log("Seeding skills...");
  await setDoc(doc(db, 'portfolio', 'skills'), skillData);

  console.log("Seeding certifications...");
  for (const item of certificationData) {
    await setDoc(doc(collection(db, 'certifications')), item);
  }

  console.log("Seeding feedbacks...");
  for (const item of feedbackData) {
    await setDoc(doc(collection(db, 'feedbacks')), item);
  }

  console.log("Seeding complete!");
  process.exit(0);
}

seedData().catch(console.error);
