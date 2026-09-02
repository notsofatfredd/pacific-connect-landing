import type { Metadata } from 'next';
import './globals.css';

export const metadata: Metadata = { title: 'Pacific Connect | Clear guidance. Practical support.', description: 'Pacific Connect helps you understand your debt and credit options and take clear next steps.' };

export default function RootLayout({ children }: Readonly<{ children: React.ReactNode }>) { return <html lang="en"><body>{children}</body></html>; }
