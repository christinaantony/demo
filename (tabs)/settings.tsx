import React, { useContext } from "react";
import { Text } from "@/components/ui/text";
import { VStack } from "@/components/ui/vstack";
import RedirectCard from "@/components/screens/settings/redirect-card";
import { Settings2, User } from "lucide-react-native";
import { SettingsIcon, SunIcon, MoonIcon } from "@/components/ui/icon";
import { LinearGradient } from "@/components/ui/linear-gradient";
import { HStack } from "@/components/ui/hstack";
import { Image } from "@/components/ui/image";
import ThemeCard from "@/components/screens/settings/theme-card";
import { ColorModeContext } from "@/app/_layout";

const Settings = () => {
  const { colorMode, setColorMode }: any = useContext(ColorModeContext);

  return (
    <VStack space="md" className="bg-background-0 flex-1">
      <LinearGradient
        colors={
          colorMode === "light"
            ? ["#D288F0", "#CCADFF"]
            : ["#080D4F", "#2C1566"]
        }
        className="rounded-b-[33px]"
      >
        <VStack className="ios:h-[197px] h-[177px] py-6 px-5 justify-end">
          <HStack className="justify-between items-start px-2">
            <Text size="2xl" className="text-typography-900 font-semibold">
              Settings
            </Text>
            <VStack className="items-center">
              <Image
                source={
                  colorMode === "light"
                    ? require("../../assets/images/light-palace.png")
                    : require("../../assets/images/dark-palace.png")
                }
                alt="image"
                size="none"
                className="h-[60px] w-[60px]"
              />
              <Text className="font-medium text-typography-800">Bengaluru</Text>
            </VStack>
          </HStack>
        </VStack>
      </LinearGradient>

      <VStack className="px-4" space="md">
        <RedirectCard title={"General info"} icon={User} />
        <RedirectCard title={"Settings"} icon={SettingsIcon} />
        <RedirectCard title={"Preferences"} icon={Settings2} />
      </VStack>

      <VStack className="px-4" space="md">
        <Text className="font-semibold">Theme</Text>
        <HStack space="sm">
          <ThemeCard
            title="Light Mode"
            icon={SunIcon}
            onPress={() => setColorMode("light")}
            active={colorMode === "light"}
          />
          <ThemeCard
            title="Dark Mode"
            icon={MoonIcon}
            onPress={() => setColorMode("dark")}
            active={colorMode === "dark"}
          />
        </HStack>
      </VStack>
    </VStack>
  );
};

export default Settings;
