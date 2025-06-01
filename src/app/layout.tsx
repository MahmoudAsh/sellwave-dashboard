import React from 'react'
import type { Metadata } from 'next'
import './globals.css'

export const metadata: Metadata = {
  title: 'Sell Wave - Built with Catalyst',
  description: 'A modern app built with Next.js and Catalyst UI',
}

export default function RootLayout({
  children,
}: {
  children: React.ReactNode
}) {
  return (
    <html lang="en" className="h-full">
      <body className="h-full bg-white antialiased dark:bg-zinc-900">
        {children}
      </body>
    </html>
  )
} 