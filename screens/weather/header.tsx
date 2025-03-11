import React, { useContext } from "react";
import { HStack } from "@/components/ui/hstack";
import { Icon, SearchIcon } from "@/components/ui/icon";
import { VStack } from "@/components/ui/vstack";
import { Text } from "@/components/ui/text";
import { Image } from "@/components/ui/image";
import { LinearGradient } from "@/components/ui/linear-gradient";
import { Box } from "@/components/ui/box";
import { ColorModeContext } from "@/app/_layout";

const Header = () => {
  const { colorMode }: any = useContext(ColorModeContext);
  return (
    <Box className="bg-background-0">
      <LinearGradient
        colors={
          colorMode === "light"
            ? ["#D288F0", "#CCADFF"]
            : ["#080A0B", "#2C1566"]
        }
        className="rounded-b-[33px] mb-3"
      >
        <VStack className="p-5 pt-16 gap-10">
          <HStack className="justify-between items-center">
            <Text className="text-background-800 font-medium" size="2xl">
              Bengaluru, India
            </Text>
            <Icon as={SearchIcon} size="xl" className="text-background-800" />
          </HStack>

          <HStack className="justify-between items-end pr-4">
            <VStack>
              <Text className="text-[112px] text-background-700 relative">
                13°
              </Text>

              <Text className="text-background-700" size="lg">
                Feels like 12°
              </Text>
            </VStack>
            <VStack className="items-center gap-10">
              <Image
                source={require("@/assets/images/cloudy.png")}
                alt="image"
                size="none"
                className="h-[57px] w-[77px]"
              />
              <Text className="font-medium text-background-700" size="xl">
                Cloudy
              </Text>
            </VStack>
          </HStack>

          <HStack className="justify-between">
            <Text size="lg" className="text-background-700">
              January 18, 16:14
            </Text>
            <VStack className="items-end">
              <Text size="lg" className="text-background-700">
                Day 23°
              </Text>
              <Text size="lg" className="text-background-700">
                Night 10°
              </Text>
            </VStack>
          </HStack>
        </VStack>
      </LinearGradient>
    </Box>
  );
};

export default Header;
