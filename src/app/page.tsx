import React from 'react'
import { Button } from '@/components/button'
import { Heading } from '@/components/heading'
import { PlusIcon, StarIcon } from '@heroicons/react/16/solid'

export default function Home() {
  return (
    <div className="min-h-screen flex items-center justify-center p-8">
      <div className="max-w-2xl mx-auto text-center space-y-8">
        <div className="space-y-4">
          <Heading level={1}>
            Welcome to Sell Wave
          </Heading>
          <p className="text-lg text-zinc-600 dark:text-zinc-400">
            A modern application built with Next.js and Catalyst UI components.
            Experience beautiful, accessible components with Tailwind CSS.
          </p>
        </div>

        <div className="flex flex-col sm:flex-row gap-4 justify-center">
          <Button>
            <PlusIcon />
            Get Started
          </Button>
          <Button outline>
            <StarIcon />
            Learn More
          </Button>
          <Button plain>
            View Demo
          </Button>
        </div>

        <div className="pt-8 border-t border-zinc-200 dark:border-zinc-700">
          <Heading level={2}>
            Features
          </Heading>
          <div className="mt-4 grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
            <div className="space-y-2">
              <h3 className="font-semibold text-zinc-950 dark:text-white">Beautiful Design</h3>
              <p className="text-sm text-zinc-600 dark:text-zinc-400">
                Carefully crafted components with attention to detail and modern aesthetics.
              </p>
            </div>
            <div className="space-y-2">
              <h3 className="font-semibold text-zinc-950 dark:text-white">Fully Accessible</h3>
              <p className="text-sm text-zinc-600 dark:text-zinc-400">
                Built with accessibility in mind using Headless UI components.
              </p>
            </div>
            <div className="space-y-2">
              <h3 className="font-semibold text-zinc-950 dark:text-white">Developer Experience</h3>
              <p className="text-sm text-zinc-600 dark:text-zinc-400">
                TypeScript-first with excellent IntelliSense and type safety.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
} 